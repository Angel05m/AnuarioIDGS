<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galeria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'galeria';
    protected $primaryKey = 'pk_galeria';

    protected $fillable = [
        'fk_usuario',
        'titulo',
        'descripcion',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_usuario');
    }

    public function imagenes()
    {
        return $this->hasMany(MasImagenes::class, 'fk_galeria', 'pk_galeria');
    }
}
