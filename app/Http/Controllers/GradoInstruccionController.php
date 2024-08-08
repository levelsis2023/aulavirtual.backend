<?php

namespace App\Http\Controllers;

use App\Models\GradoInstruccion;
use Illuminate\Http\Request;

class GradoInstruccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gradoInstrucion = GradoInstruccion::paginate(10);

        return response()->json($gradoInstrucion, 200);
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
            'nivel' => 'required',
            'porcentaje' => 'required',
        ]);

        $gradoInstrucion = GradoInstruccion::create($request->all());

        return response()->json(['message' => 'Grado de instrucción  creado correctamente', 'data' => $gradoInstrucion], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gradoInstrucion = GradoInstruccion::find($id);

        if (!$gradoInstrucion) {
            return response()->json(['message' => 'Grado de instrucción  no encontrado'], 404);
        }

        return response()->json(['data' => $gradoInstrucion], 200);
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
            'nivel' => 'required',
            'porcentaje' => 'required',
        ]);

        $gradoInstrucion = GradoInstruccion::find($id);

        if (!$gradoInstrucion) {
            return response()->json(['message' => 'Grado de instrucción no encontrado'], 404);
        }

        $gradoInstrucion->update($request->all());

        return response()->json(['message' => 'Grado de instrucción actualizado correctamente', 'data' => $gradoInstrucion], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gradoInstrucion = GradoInstruccion::find($id);

        if (!$gradoInstrucion) {
            return response()->json(['message' => 'Grado de instrucción no encontrado'], 404);
        }

        $gradoInstrucion->delete();

        return response()->json(['message' => 'Grado de instrucción eliminado correctamente'], 204);
    }
}
