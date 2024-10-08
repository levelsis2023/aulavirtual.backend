<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluaciones extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'nombre',
        'tipo_evaluacion_id',
        'porcentaje_evaluacion',
        'fecha_y_hora_programo',
        'fecha_y_hora_realizo',
        'observaciones',
        'estado_id',
        'domain_id',
        'deleted_at',
        'grupo_de_evaluaciones_id'
    ];

    // Define relationships if needed
    public function tipoEvaluacion()
    {
        return $this->belongsTo(TipoEvaluacion::class, 'tipo_evaluacion_id', 'nu_id_parametro');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'id');
    }

    public function grupoDeEvaluaciones()
    {
        return $this->belongsTo(GrupoDeEvaluaciones::class);
    }
}