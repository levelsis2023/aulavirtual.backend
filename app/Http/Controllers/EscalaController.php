<?php

namespace App\Http\Controllers;

use App\Models\Escala;
use Illuminate\Http\Request;

class EscalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($domain_id)
    {
        if ($domain_id == NULL || $domain_id == 0) {

            $escala = Escala::all();
        } else
        {
            $escala = Escala::paginate(10);
        }

        

        return response()->json($escala, 200);
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
            'c' => 'required',
            'color' => 'required',
        ]);

        $escala = Escala::create($request->all());

        return response()->json(['message' => 'escala creada correctamente', 'data' => $escala], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $escala = Escala::find($id);

        if (!$escala) {
            return response()->json(['message' => 'escala no encontrada'], 404);
        }

        return response()->json(['data' => $escala], 200);
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
            'c' => 'required',
            'color' => 'required',
        ]);

        $escala = Escala::find($id);

        if (!$escala) {
            return response()->json(['message' => 'escala no encontrada'], 404);
        }

        $escala->update($request->all());

        return response()->json(['message' => 'escala actualizada correctamente', 'data' => $escala], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $escala = Escala::find($id);

        if (!$escala) {
            return response()->json(['message' => 'escala no encontrada'], 404);
        }

        $escala->delete();

        return response()->json(['message' => 'escala eliminada correctamente'], 204);
    }
}
