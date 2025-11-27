<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'contenido',
        'categoria',
        'estado',              // 'borrador' | 'publicado'
        'imagen',
        'likes_count',
        'views_count',
        'fecha_publicacion',   // <- fecha y hora reales de publicación
    ];

    protected $casts = [
        'fecha_publicacion' => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];

    /* ===========================
     |  Relaciones
     * =========================== */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ AGREGADO: reacciones/likes
    public function reactions()
    {
        return $this->hasMany(\App\Models\Reaction::class);
    }

    /* ===========================
     |  Accessors / Attributes
     * =========================== */

    // URL pública de la imagen (sirve en Blade como $publication->image_url)
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->imagen) {
            return null;
        }

        // Limpia prefijo 'public/' si viene así de la BD
        $path = preg_replace('#^public/#', '', $this->imagen);

        // Devuelve URL desde /storage (requiere php artisan storage:link)
        return asset('storage/' . $path);
    }

    // Fecha a mostrar: usa fecha_publicacion si existe; si no, created_at
    // En Blade: {{ $publication->shown_at?->format('d/m/Y H:i') }}
    public function getShownAtAttribute()
    {
        return $this->fecha_publicacion ?? $this->created_at;
    }

    /* ===========================
     |  Scopes (helpers de consulta)
     * =========================== */

    // Filtra por dueño
    public function scopeOwnedBy($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Sólo publicadas
    public function scopePublished($query)
    {
        return $query->where('estado', 'publicado');
    }

    // Ordena por fecha de publicación (o created_at si no hay)
    public function scopeOrderByShownAt($query, $dir = 'DESC')
    {
        return $query->orderByRaw(
            "COALESCE(fecha_publicacion, created_at) " . ($dir === 'ASC' ? 'ASC' : 'DESC')
        );
    }
}
