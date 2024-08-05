<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Docente;

class CursoDocenteController extends Controller
{
    // Método para listar cursos por docente
    public function index($docente_id)
    {
        try {
            $courses = Curso::leftJoin('t_g_parametros as ciclo', 'ciclo.nu_id_parametro', '=', 'cursos.ciclo_id')
                ->leftJoin('t_g_parametros as modulo_formativo', 'modulo_formativo.nu_id_parametro', '=', 'cursos.modulo_formativo_id')
                ->leftJoin('t_g_parametros as area_de_formacion', 'area_de_formacion.nu_id_parametro', '=', 'cursos.area_de_formacion_id')
                ->leftJoin('t_g_parametros as estado', 'estado.nu_id_parametro', '=', 'cursos.estado_id')
                ->leftJoin('carreras', 'carreras.id', '=', 'cursos.carrera_id')
                ->leftJoin('docentes', 'docentes.id', '=', 'cursos.docente_id')
                ->where('cursos.docente_id', $docente_id)
                ->select(
                    'cursos.*',
                    'ciclo.tx_item_description as ciclo_nombre',
                    'modulo_formativo.tx_item_description as modulo_formativo_nombre',
                    'area_de_formacion.tx_item_description as area_de_formacion_nombre',
                    'carreras.nombres as carrera_nombre',
                    'estado.tx_item_description as estado_nombre',  
                    'docentes.id as docente_id'
                )
                ->get();

            return response()->json($courses);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Método para asignar un curso a un docente
    public function assign(Request $request)
    {
        try {
            $this->validate($request, [
                'curso_id' => 'required|integer|exists:cursos,id',
                'docente_id' => 'required|integer|exists:docentes,id',
            ]);

            $curso = Curso::findOrFail($request->curso_id);
            $curso->docente_id = $request->docente_id;
            $curso->save();

            return response()->json($curso, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
