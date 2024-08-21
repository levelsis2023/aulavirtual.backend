<?php

namespace App\Http\Controllers;

use App\Models\ModalidadPuesto;
use Illuminate\Http\Request;

class ModalidadPuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($domain_id)
    {
        if ($domain_id == NULL || $domain_id == 0) {

            $modalidadPuesto = ModalidadPuesto::all();
        } else
        {
            $modalidadPuesto = ModalidadPuesto::paginate(10);
        }

        
        return response()->json($modalidadPuesto, 200);
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

        $modalidadPuesto = ModalidadPuesto::create($request->all());

        return response()->json(['message' => 'Modalidad de puesto creado correctamente', 'data' => $modalidadPuesto], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $modalidadPuesto = ModalidadPuesto::find($id);

        if (!$modalidadPuesto) {
            return response()->json(['message' => 'Modalidad de puesto no encontrado'], 404);
        }

        return response()->json(['data' => $modalidadPuesto], 200);
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

        $modalidadPuesto = ModalidadPuesto::find($id);

        if (!$modalidadPuesto) {
            return response()->json(['message' => 'Modalidad de puesto no encontrado'], 404);
        }

        $modalidadPuesto->update($request->all());

        return response()->json(['message' => 'Modalidad de puesto actualizado correctamente', 'data' => $modalidadPuesto], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $modalidadPuesto = ModalidadPuesto::find($id);

        if (!$modalidadPuesto) {
            return response()->json(['message' => 'Modalidad de puesto no encontrado'], 404);
        }

        $modalidadPuesto->delete();

        return response()->json(['message' => 'Modalidad de puesto eliminado correctamente'], 204);
    }
}
