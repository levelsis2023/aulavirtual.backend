<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;

    protected $table = 'instituciones'; // Opcional si el nombre de la tabla no es el plural del nombre del modelo

    protected $fillable = [
        'nombre',
        'siglas',
        'director',
        'logotipo',
        'color_fondo',
        'color_texto'
        //'domain_id'
    ];
}
