<?php

namespace App\Http\Controllers;

use App\Models\EstadoAvance;
use Illuminate\Http\Request;

class EstadoAvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($domain_id)
    {
        if ($domain_id == NULL || $domain_id == 0) {

            $EstadoAvance = EstadoAvance::all();
        } else
        {
            $EstadoAvance = EstadoAvance::paginate(10);
        }

        
        return response()->json($EstadoAvance, 200);
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

        $EstadoAvance = EstadoAvance::create($request->all());

        return response()->json(['message' => 'Estado de avance creado correctamente', 'data' => $EstadoAvance], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $EstadoAvance = EstadoAvance::find($id);

        if (!$EstadoAvance) {
            return response()->json(['message' => 'Estado de avance  no encontrado'], 404);
        }

        return response()->json(['data' => $EstadoAvance], 200);
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

        $EstadoAvance = EstadoAvance::find($id);

        if (!$EstadoAvance) {
            return response()->json(['message' => 'Estado de avance no encontrado'], 404);
        }

        $EstadoAvance->update($request->all());

        return response()->json(['message' => 'Estado de avance actualizado correctamente', 'data' => $EstadoAvance], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $EstadoAvance = EstadoAvance::find($id);

        if (!$EstadoAvance) {
            return response()->json(['message' => 'Estado de avance no encontrado'], 404);
        }

        $EstadoAvance->delete();

        return response()->json(['message' => 'Estado de avance eliminado correctamente'], 204);
    }
}
