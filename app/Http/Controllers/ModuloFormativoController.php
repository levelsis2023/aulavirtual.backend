<?php

namespace App\Http\Controllers;

use App\Models\ModuloFormativo;
use Illuminate\Http\Request;

class ModuloFormativoController extends Controller
{
    public function index()
    {
        $modulos = ModuloFormativo::all();
        return response()->json($modulos);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
            'area_de_formacion_id' => 'required|integer',
        ]);

        $modulo = ModuloFormativo::create($request->all());
        return response()->json($modulo, 201);
    }

    public function show($id)
    {
        $modulo = ModuloFormativo::find($id);
        if (!$modulo) {
            return response()->json(['mensaje' => 'Módulo no encontrado', 'status' => 404], 404);
        }
        return response()->json($modulo);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'string|max:255',
            'area_de_formacion_id' => 'integer',
        ]);

        $modulo = ModuloFormativo::find($id);
        if (!$modulo) {
            return response()->json(['mensaje' => 'Módulo no encontrado', 'status' => 404], 404);
        }

        $modulo->update($request->all());
        return response()->json($modulo);
    }

    public function destroy($id)
    {
        $modulo = ModuloFormativo::find($id);
        if (!$modulo) {
            return response()->json(['mensaje' => 'Módulo no encontrado', 'status' => 404], 404);
        }

        $modulo->delete();
        return response()->json(['mensaje' => 'Módulo eliminado', 'status' => 200], 200);
    }

    public function restore($id)
    {
        $modulo = ModuloFormativo::withTrashed()->find($id);
        if (!$modulo) {
            return response()->json(['mensaje' => 'Módulo no encontrado', 'status' => 404], 404);
        }

        $modulo->restore();
        return response()->json(['mensaje' => 'Módulo restaurado', 'status' => 200], 200);
    }
}