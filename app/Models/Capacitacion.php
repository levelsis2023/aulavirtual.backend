<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    protected $table = 'capacitaciones';
    protected $fillable = ['codigo', 'nombre', 'horas', 'sylabus', 'temas', 'idEstado', 'docente', 'fecha', 'estado'];

}
