<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = [
        'codigo',
        'nombres',
        'apellidos',
        'celular',
        'email',
        'carrera_id',
        'ciclo_id',
        'dni',
        'fecha_nacimiento',
        'genero',
        'direccion',
        'foto_perfil',
        'foto_carnet',
        'dominio'
    ];
}
