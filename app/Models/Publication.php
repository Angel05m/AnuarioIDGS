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
        'estado',
        'imagen',
        'likes_count',
        'views_count',
        'fecha_publicacion',
    ];

    protected $casts = [
        'fecha_publicacion' => 'datetime',
    ];

    // Relación con usuario (opcional para mostrar autor en vista)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔹 Accessor para obtener la URL completa de la imagen
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->imagen) {
            return null;
        }

        

        // Limpia posibles prefijos incorrectos como 'public/'
        $path = preg_replace('#^public/#', '', $this->imagen);

        // Devuelve la URL pública desde /storage/
        return asset('storage/' . $path);
    }

    // …dentro de la clase Publication
public function scopeOwnedBy($query, $userId)
{
    return $query->where('user_id', $userId);
}

}
