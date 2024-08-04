<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForoController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'id_curso' => 'required|integer',
        ]);

        $foro = DB::table('foros')->insert([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_curso' => $request->id_curso,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'domain_id' => $request->domain_id,
        ]);

        return response()->json($foro, 201);

    }
    public function show($domain_id)
    {

        $results = DB::table('cursos AS c')
    ->select(
        'c.nombre AS curso_name',
        'd.nombres AS docente_name',
        DB::raw("
            JSON_ARRAYAGG(
                JSON_OBJECT(
                    'fecha_inicio', f.fecha_inicio,
                    'fecha_fin', f.fecha_fin,
                    'id_foro', f.id,
                    'respuestas', IFNULL((
                        SELECT JSON_ARRAYAGG(
                            JSON_OBJECT(
                                
                                'alumno', a.nombres,
                                'respuesta', fr.respuesta,
                                'fecha', fr.created_at
                            )
                        )
                        FROM foro_respuestas AS fr
                        JOIN alumnos AS a ON a.id = fr.alumno_id
                        WHERE fr.foro_id = f.id
                    ), '[]')
                )
            ) AS foros
        ")
    )
    ->join('foros AS f', 'f.id_curso', '=', 'c.id')
    ->join('docentes AS d', 'd.id', '=', 'c.docente_id')
    ->where('c.domain_id', 2)
    ->groupBy('c.id', 'c.nombre', 'd.nombres')
    ->get()
    ->map(function ($item) {
        return [
            'curso_name' => $item->curso_name,
            'docente_name' => $item->docente_name,
            'foros' => json_decode($item->foros) // Parseo del JSON a un array de objetos
        ];
    });
        
        return response()->json($results, 200);
    }
    
}