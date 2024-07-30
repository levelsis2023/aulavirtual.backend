<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Empresa;
use App\Models\Permiso;
use App\Models\Rol;
use DateTime;

class PermisoController extends Controller
{
    public function index()
    {
        $data = Permiso::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'database' => 'required|string|max:255',
            'status' => 'required|numeric',
        ]);

        $empresa = Empresa::create([
            'name' => $request->name,
            'domain' => $request->domain,
            'database' => $request->database,
            'status' => $request->status,
        ]);

        return response()->json($empresa, 201);
    }

    public function show($id)
    {
        $data = Empresa::find($id);
        return response()->json($data,200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'database' => 'required|string|max:255',
            'status' => 'required|numeric',
        ]);

        $empresa = Empresa::find($id);

        $empresa->name = $request->name;
        $empresa->domain = $request->domain;
        $empresa->database = $request->database;
        $empresa->status = $request->status;

        return response()->json($empresa, 201);
    }

    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        $empresa->delete();

        return response()->json(['mensaje' => "Se eliminó la empresa"], 200);
    }
}
