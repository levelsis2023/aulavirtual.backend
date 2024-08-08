<?php

namespace App\Http\Controllers;

use App\Models\Accion;
use Illuminate\Http\Request;

class AccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accion = Accion::paginate(10);
        return response()->json($accion, 200);
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
            'color' => 'required',
        ]);

        $accion = Accion::create($request->all());

        return response()->json(['message' => 'acción creada correctamente', 'data' => $accion], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $accion = Accion::find($id);

        if (!$accion) {
            return response()->json(['message' => 'acción  no encontrada'], 404);
        }

        return response()->json(['data' => $accion], 200);
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
            'color' => 'required',
        ]);

        $accion = Accion::find($id);

        if (!$accion) {
            return response()->json(['message' => 'acción no encontrada'], 404);
        }

        $accion->update($request->all());

        return response()->json(['message' => 'acción actualizada correctamente', 'data' => $accion], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $accion = Accion::find($id);

        if (!$accion) {
            return response()->json(['message' => 'acción no encontrada'], 404);
        }

        $accion->delete();

        return response()->json(['message' => 'acción eliminada correctamente'], 204);
    }
}
