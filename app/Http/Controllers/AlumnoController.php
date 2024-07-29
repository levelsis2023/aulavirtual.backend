<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index(){
      $alumnos = Alumno::leftJoin('t_g_parametros as ciclo', 'ciclo.nu_id_parametro', '=', 'alumnos.ciclo_id')
          ->leftJoin('carreras', 'carreras.id', '=', 'alumnos.carrera_id')

              ->select(
                  'alumnos.*',
                  'ciclo.tx_abreviatura as ciclo_nombre',
                  'carreras.nombres as carrera_nombre'
              )->get();
      return response()->json($alumnos);
    }
    public function store(Request $request){
        $this->validate($request, [
            'codigo' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'cicloId' => 'required|integer',
            'carreraId' => 'required|integer',
            'dni' => 'required|string|max:255',
        ]);
        $alumno = Alumno::create($request->all());
        return response()->json($alumno, 201);
    }
    public function update(Request $request, $id){
        $this->validate($request, [
            'codigo' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'cicloId' => 'required|integer',
            'carreraId' => 'required|integer',
            'dni' => 'required|string|max:255',
        ]);
        $dominio = $request->input('dominio');
        $alumno = Alumno::where('id', $id)->where('dominio', $dominio)->first();
        if ($alumno) {
            $alumno->update($request->all());
            return response()->json($alumno, 201);
        }
        return response()->json('Record not found', 404);
    }
    public function destroy($id, $dominio)
    {
        $alumno = Alumno::where('id', $id)->where('dominio', $dominio)->first();
        if ($alumno) {
            $alumno->delete_at = Carbon::now();
            $alumno->save();
            return response()->json('Record deleted', 201);
        }
        return response()->json('Record not found', 404);
    }
    public function show($id, $dominio){
        $carrera = Alumno::where('id', $id)->where('domain_id', $dominio)->first();
        if ($carrera) {
            return response()->json($carrera);
        }
        return response()->json('Record not found', 404);
    }
}
