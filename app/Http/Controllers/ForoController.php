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
        ]);

        return response()->json($foro, 201);

    }
}
