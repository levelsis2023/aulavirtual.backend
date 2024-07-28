<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    // Definir los atributos asignables
    protected $fillable = [
        'nombre',
        'codigo',
        'cantidad_de_creditos',
        'cantidad_de_horas',
        'porcentaje_de_creditos',
        'ciclo_id',
        'carrera_id',
        'modulo_formativo_id',
        'area_de_formacion_id',
        'syllabus'
    ];

    // Definir la relación con el modelo Ciclo
    public function ciclo()
    {
        return $this->belongsTo(Parametro::class, 'ciclo_id', 'nu_id_parametro');
    }

    // Definir la relación con el modelo ModuloFormativo
    public function moduloFormativo()
    {
        return $this->belongsTo(Parametro::class, 'modulo_formativo_id', 'nu_id_parametro');
    }

    // Definir la relación con el modelo AreaDeFormacion
    public function areaDeFormacion()
    {
        return $this->belongsTo(Parametro::class, 'area_de_formacion_id', 'nu_id_parametro');
    }

    // Definir la relación con el modelo Carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }
}