<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AsistenciaCursoController extends Controller
{
    public function show(Request $request)
    {
        $cursoId = $request->input('curso_id');
        $domainId = $request->input('domain_id');
        $fecha = $request->input('fecha');

//        return response()->json([]);

        $participantes = DB::table('curso_alumno as ca')
    ->select(
        'ca.curso_id',
        'ca.alumno_id',
        'ca.domain_id',
        'a.codigo',
        DB::raw("concat(a.nombres,' ',a.apellidos) as nombres"),
        DB::raw("(CASE WHEN EXISTS (SELECT 1 FROM curso_asistencia cas2 WHERE cas2.id = cas.id) THEN 1 ELSE 0 END) as is_marked")
    )
    ->join('alumnos as a', 'ca.alumno_id', '=', 'a.id')
    ->leftJoin('curso_asistencia as cas', function($join) use ($fecha) {
        $join->on('ca.alumno_id', '=', 'cas.alumno_id')
             ->where('cas.fecha', '=', $fecha);
    })
    ->where('ca.curso_id', $cursoId)
    ->where('ca.domain_id', $domainId)
    ->get();

        $horarios = DB::table('curso_horario')
            ->where('curso_id',$cursoId)
            ->where('domain_id',$domainId)
            ->select(
                'day_id',
                DB::raw('TIMESTAMP(fecha_inicio) as fecha_inicio'),
                DB::raw('TIMESTAMP(fecha_fin) as fecha_fin')
            )->get();
        return response()->json(['participantes'=>$participantes,'horarios'=>$horarios]);
    }
    public function store(Request $request){

        $alumnoId = $request->input('alumno_id');
        $cursoId = $request->input('curso_id');
        $domainId = $request->input('domain_id');
        $fecha = $request->input('fecha');
        $asistencia = DB::table('curso_asistencia')
            ->where('alumno_id',$alumnoId)
            ->where('curso_id',$cursoId)
            ->where('domain_id',$domainId)
            ->where('fecha',$fecha)
            ->first();
        if($asistencia){
            //delete
            DB::table('curso_asistencia')->where('id', $asistencia->id)->delete();
        }else{
            //insert
            DB::table('curso_asistencia')->insert([
                'alumno_id' => $alumnoId,
                'curso_id' => $cursoId,
                'domain_id' => $domainId,
                'fecha' => $fecha
            ]);
        }
        return response()->json('ok');
    }
}
