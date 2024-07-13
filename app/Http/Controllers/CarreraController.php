<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index(Request $request){
        if(!$request){
            return response()->json('Not parameter domain');
        }
        $id = $request->query('dominio');
        echo $id;
        $carrera = Carrera::find($id);
        if($carrera){
            return response()->json($carrera);
        }
        return response()->json('Record not found', 404);
    }
    public function store(Request $request){
        $this->validate($request, [
            'codigo' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'dominio' => 'required|string|max:255',
        ]);
        $carrera = Carrera::create($request->all());
        return response()->json($carrera, 201);
    }
    public function update($id, $dominio, Request $request){
        $this->validate($request, [
            'codigo' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'dominio' => 'required|string|max:255',
        ]);
        $carrera = Carrera::where('id', $id)->where('dominio', $dominio)->first();
        if ($carrera) {
                $carrera->update($request->all());
                return response()->json($carrera, 201);
            }
            return response()->json('Record not found', 404);
    }
    public function destroy($id, $dominio)
    {
        $carrera = Carrera::where('id', $id)->where('dominio', $dominio)->first();
        if ($carrera) {
            $carrera->delete();
            return response()->json('Record deleted', 201);
        }
        return response()->json('Record not found', 404);
    }
    public function show($id, $dominio){
        $carrera = Carrera::where('id', $id)->where('dominio', $dominio)->first();
        if ($carrera) {
            return response()->json($carrera);
        }
        return response()->json('Record not found', 404);
    }
}
