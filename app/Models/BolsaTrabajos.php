<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BolsaTrabajos extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'bolsa_trabajo';
    protected $primaryKey = 'pk_bolsa_trabajo';

    protected $fillable=[
        'fk_usuario',
        'nombre_empresa',
        'correo',
        'telefono',
        'puesto',
        'descripcion',
        'direccion',
        'tipo_empleo',
        'requisito',
        'salario'
    ];
}
