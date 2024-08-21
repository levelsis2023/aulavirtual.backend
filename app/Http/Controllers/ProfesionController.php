<?php

namespace App\Http\Controllers;

use App\Models\Profesion;
use Illuminate\Http\Request;

class ProfesionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($domain_id)
    {
        if ($domain_id == NULL || $domain_id == 0) {

            $profesion = Profesion::all();
        } else
        {
            $profesion = Profesion::paginate(10);
        }

        
        return response()->json($profesion, 200);
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

        $profesion = Profesion::create($request->all());

        return response()->json(['message' => 'Profesion creada correctamente', 'data' => $profesion], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $profesion = Profesion::find($id);

        if (!$profesion) {
            return response()->json(['message' => 'Profesion  no encontrada'], 404);
        }

        return response()->json(['data' => $profesion], 200);
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

        $profesion = Profesion::find($id);

        if (!$profesion) {
            return response()->json(['message' => 'Profesion no encontrada'], 404);
        }

        $profesion->update($request->all());

        return response()->json(['message' => 'Profesion actualizado correctamente', 'data' => $profesion], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profesion = Profesion::find($id);

        if (!$profesion) {
            return response()->json(['message' => 'Profesion no encontrada'], 404);
        }

        $profesion->delete();

        return response()->json(['message' => 'Profesion eliminada correctamente'], 204);
    }
}
