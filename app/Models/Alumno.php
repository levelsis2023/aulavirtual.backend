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

    public function ciclo()
    {
        return $this->belongsTo(Parametro::class, 'ciclo_id', 'nu_id_parametro');
    }

    // Definir la relación con el modelo Carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }

    // Definir la relación con el modelo Estado
    public function estado()
    {
        return $this->belongsTo(Parametro::class, 'estado_id', 'nu_id_parametro');
    }
}
