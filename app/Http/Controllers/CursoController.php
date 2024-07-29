<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index($id)
    {
        $courses = Curso::leftJoin('t_g_parametros as ciclo', 'ciclo.nu_id_parametro', '=', 'cursos.ciclo_id')
        ->leftJoin('t_g_parametros as modulo_formativo', 'modulo_formativo.nu_id_parametro', '=', 'cursos.modulo_formativo_id')
        ->leftJoin('t_g_parametros as area_de_formacion', 'area_de_formacion.nu_id_parametro', '=', 'cursos.area_de_formacion_id')
        ->leftJoin('carreras', 'carreras.id', '=', 'cursos.carrera_id')
        ->where('cursos.carrera_id', $id)
        ->select(
            'cursos.*',
            'ciclo.tx_abreviatura as ciclo_nombre',
            'modulo_formativo.tx_abreviatura as modulo_formativo_nombre',
            'area_de_formacion.tx_abreviatura as area_de_formacion_nombre',
            'carreras.nombres as carrera_nombre'
        )
        ->get();

    return response()->json($courses);
    }

 
    public function store(Request $request){
        $this->validate($request, [
            'codigo' => 'required|string|max:255',
            'nombreCurso' => 'required|string|max:255',
            'cicloId' => 'required|integer',
            'areaFormacionId' => 'required|integer',
            'moduloFormativoId' => 'required|integer',
            'cantidadCreditos' => 'required|integer',
            'porcentajeCreditos' => 'required|integer',
            'cantidadHoras' => 'required|integer',
            'carreraId' => 'required|integer',
            'syllabus' => 'required|string',
            'estadoId' => 'required|integer',
        ]);
    
        $curso = Curso::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombreCurso,
            'ciclo_id' => $request->cicloId,
            'area_de_formacion_id' => $request->areaFormacionId,
            'modulo_formativo_id' => $request->moduloFormativoId,
            'cantidad_de_creditos' => $request->cantidadCreditos,
            'porcentaje_de_creditos' => $request->porcentajeCreditos,
            'cantidad_de_horas' => $request->cantidadHoras,
            'carrera_id' => $request->carreraId,
            'syllabus' => $request->syllabus,
            'estado_id' => $request->estadoId,
        ]);
    
        return response()->json($curso, 201);
    }

    public function show($id)
    {
        // Your code here
    }

    public function update(Request $request, $id)
    {
        // Your code here
    }

    public function destroy($id)
    {
        // Your code here
    }
}
