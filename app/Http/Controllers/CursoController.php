<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index()
    {
        // Your code here
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
