<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = 'galeria';
    protected $primaryKey = 'pk_galeria';

    protected $fillable = [
        'fk_usuario',
        'titulo',
        'descripcion',
        'ruta_imagen',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'fk_usuario');
    }
}
