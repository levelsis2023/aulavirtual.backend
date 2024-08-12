<?php

namespace App\Http\Controllers;

use App\Models\VinculoLaboral;
use Illuminate\Http\Request;

class VinculoLaboralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vinculoLaboral = VinculoLaboral::paginate(10);
        return response()->json($vinculoLaboral, 200);
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

        $vinculoLaboral = VinculoLaboral::create($request->all());

        return response()->json(['message' => 'vínculo laboral creado correctamente', 'data' => $vinculoLaboral], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vinculoLaboral = VinculoLaboral::find($id);

        if (!$vinculoLaboral) {
            return response()->json(['message' => 'vínculo laboral no encontrado'], 404);
        }

        return response()->json(['data' => $vinculoLaboral], 200);
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

        $vinculoLaboral = VinculoLaboral::find($id);

        if (!$vinculoLaboral) {
            return response()->json(['message' => 'vínculo laboral no encontrado'], 404);
        }

        $vinculoLaboral->update($request->all());

        return response()->json(['message' => 'vínculo laboral actualizado correctamente', 'data' => $vinculoLaboral], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vinculoLaboral = VinculoLaboral::find($id);

        if (!$vinculoLaboral) {
            return response()->json(['message' => 'vínculo laboral no encontrado'], 404);
        }

        $vinculoLaboral->delete();

        return response()->json(['message' => 'vínculo laboral eliminado correctamente'], 204);
    }
}
