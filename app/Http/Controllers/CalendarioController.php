<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarioController extends Controller
{
    public function getAlumnoCalendario(Request $request)
    {
        $alumnoId = $request->input('alumno_id');
        $domainId = $request->input('domain_id');
        $eventos = DB::table('alumnos as a')
            ->select('a.id', 'c.nombre')
            ->selectRaw('COALESCE(
        (SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
                "day_id", ch.day_id,
                "hora_inicio",ch.hora_inicio,
                "hora_fin",ch.hora_fin ,
                "fecha_inicio",ch.fecha_inicio,
                "fecha_fin",ch.fecha_fin,
                "docente_name",d.nombres 
            )
        )
        FROM curso_horario ch
        join docentes d on d.id =ch.docente_id  
        WHERE ch.curso_id = ca.curso_id
        and ch.domain_id =1
        ), "[]") AS horarios')
            ->join('curso_alumno as ca', 'ca.alumno_id', '=', 'a.id')
            ->join('cursos as c', 'c.id', '=', 'ca.curso_id')
            ->where('a.id', $alumnoId)
            ->groupBy('a.id', 'c.nombre', 'horarios')
            ->get();
        return response()->json($eventos);
    }
    public function getDocenteCalendario(Request $request)
    {
        $docenteId = $request->input('docente_id');
        $eventos = DB::table('docentes as d')
            ->select('d.id')
            ->selectRaw('COALESCE((
            SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                    "day_id", ch.day_id,
                    "hora_inicio", ch.hora_inicio,
                    "hora_fin", ch.hora_fin,
                    "fecha_inicio", ch.fecha_inicio,
                    "fecha_fin", ch.fecha_fin,
                    "cursoNombre", c.nombre
                )
            )
            FROM curso_horario ch
            JOIN cursos c ON c.id = ch.curso_id
            WHERE ch.curso_id = c.id
            AND ch.domain_id = 1
        ), "[]") AS horarios')
            ->where('d.id', $docenteId)
            ->groupBy('d.id', 'horarios')
            ->get();
        return response()->json($eventos);
    }
}
