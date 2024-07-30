<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HorarioController extends Controller
{
    public function index(Request $request)
    {
        return response()->json('HorarioController@index');
    }
    public function store(Request $request)
    {
        $cursoId = $request->input('curso_id');
        $docenteId = $request->input('docente_id');
        $domainId = $request->input('domain_id');
        $horarios= $request->input('horarios');
        $fechaInicio = date('Y-m-d', strtotime($request->input('fechaInicio')));
        $fechaFin = date('Y-m-d', strtotime($request->input('fechaFin')));
        $deselectedHorarios= $request->input('deselectedHorarios');
        foreach($deselectedHorarios as $deselectedHorario){
            $horarioId = $deselectedHorario;
            if($horarioId!=-1){
                DB::table('curso_horario')->where('id', $horarioId)->delete();
            }
        }
        foreach($horarios as $horario){
            $horaInicio = $horario['inicio'];
            $horaFin = $horario['fin'];
            $dayId = $horario['value'];
            $horarioId = $horario['id'];
            $cursoHorario = [
                'curso_id' => $cursoId,
                'docente_id' => $docenteId,
                'domain_id' => $domainId,
                'day_id' => $dayId,
                'hora_inicio' => $horaInicio,
                'hora_fin' => $horaFin,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,

            ];
            //insertar en la tabla curso_horario
            if($horarioId!=-1){
                $cursoHorario['id'] = $horarioId;
                DB::table('curso_horario')->where('id', $horarioId)->update($cursoHorario);
            }else{ 
                DB::table('curso_horario')->insert($cursoHorario);
            }

        }
        
    }
    public function show($id)
    {
        //select al from curso_horario where id = $id
        $horario = DB::table('curso_horario')->where('curso_id', $id)->get();
        return response()->json($horario);
    }
    
}