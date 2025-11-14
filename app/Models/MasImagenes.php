<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasImagenes extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mas_imagenes';
    protected $primaryKey = 'pk_mas_imagenes';

    protected $fillable = [
        'fk_galeria',
        'ruta_imagen',
    ];

    public function galeria()
    {
        return $this->belongsTo(Galeria::class, 'fk_galeria', 'pk_galeria');
    }
}
