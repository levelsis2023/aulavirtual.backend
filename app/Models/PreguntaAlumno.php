<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreguntaAlumno extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pregunta_alumno';

    protected $fillable = [
        'pregunta_id',
        'alumno_id',
        'calificacion',
        'estado',
        'respuesta',
        'url',
        'docente_id',
        'domain_id', // Si estás usando addDomainId() para agregar esta columna
    ];

    protected $casts = [
        'calificacion' => 'decimal:2',
    ];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }
}