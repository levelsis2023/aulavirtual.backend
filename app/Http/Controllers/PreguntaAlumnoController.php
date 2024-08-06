<?php

namespace App\Http\Controllers;
use App\Models\PreguntaAlumno;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PreguntaAlumnoController extends Controller
{
    public function guardarAlumnoPregunta(Request $request)
    {
        try {

            // Validar la solicitud
            $this->validate($request, [
                'alumno_id' => 'required|integer|exists:alumnos,id',
                'pregunta_id' => 'required|integer|exists:preguntas,id',
                
            ]);
          

            // Guardar la relación en la tabla pregunta_alumno
            DB::table('pregunta_alumno')->insert([
                'alumno_id' => $request->alumno_id,
                'pregunta_id' => $request->pregunta_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'respuesta' => $request->respuesta,
                'evaluacion_id' => $request->evaluacion_id,
                'domain_id' => $request->domain_id,
                'estado_id' => $request->estado_id,
            ]);
           
            return response()->json(['message' => 'Relación alumno-pregunta guardada exitosamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function obtenerCursosConEvaluaciones($curso_id)
    {
        try {
            $result = DB::table('cursos as c')
                ->join('grupo_de_evaluaciones as gde', 'c.id', '=', 'gde.curso_id')
                ->join('evaluaciones as e', 'e.grupo_de_evaluaciones_id', '=', 'gde.id')
                ->where('c.id', $curso_id)
                ->select('c.*', 'gde.*', 'e.*')
                ->get();

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function obtenerPreguntasNoCorregidas($pregunta_id)
    {
        try {
            $result = PreguntaAlumno::with('pregunta')
            ->where('pregunta_id', $pregunta_id)
            ->whereNull('calificacion')
            ->get();

        return response()->json($result);

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
