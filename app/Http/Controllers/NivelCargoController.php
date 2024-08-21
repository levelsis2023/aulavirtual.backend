<?php

namespace App\Http\Controllers;

use App\Models\NivelCargo;
use Illuminate\Http\Request;

class NivelCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($domain_id)
    {
        if ($domain_id == NULL || $domain_id == 0) {

            $nivel = NivelCargo::all();
        } else
        {
            $nivel = NivelCargo::paginate(10);
        }

        

        return response()->json($nivel, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'nombre' => 'required',
        ]);

        $nivel = NivelCargo::create($request->all());

        return response()->json(['message' => 'Nivel creado correctamente', 'data' => $nivel], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nivel = NivelCargo::find($id);

        if (!$nivel) {
            return response()->json(['message' => 'nivel  no encontrada'], 404);
        }

        return response()->json(['data' => $nivel], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nombre' => 'required',
        ]);

        $nivel = NivelCargo::find($id);

        if (!$nivel) {
            return response()->json(['message' => 'nivel no encontrado'], 404);
        }

        $nivel->update($request->all());

        return response()->json(['message' => 'Nivel actualizado correctamente', 'data' => $nivel], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nivel = NivelCargo::find($id);

        if (!$nivel) {
            return response()->json(['message' => 'nivel no encontrada'], 404);
        }

        $nivel->delete();

        return response()->json(['message' => 'nivel eliminada correctamente'], 204);
    }
}
