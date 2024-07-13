<?php

namespace App\Http\Controllers;

use App\Models\TGParametro;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    public function index(Request $request){
        if(!$request){
            return response()->json('Send the parameter of domain');
        }
        $id = $request->query('dominio');
        $Parametros = TGParametro::find($id);
        if($Parametros){
            return response()->json($Parametros);
        }
        return response()->json('Record not found', 404);
    }
    public function store(Request $request){
        $this->validate($request, [
            'tx_nombre' => 'required|string|max:255',
            'tx_abreviatura' => 'required|string|max:255',
            'nu_item' => 'required|integer',
            'tx_item_description' => 'required|string|max:255',
            'dominio' => 'required|string|max:255',
        ]);
        $parametro = TGParametro::create($request->all());
        return response()->json($parametro, 201);
    }
    public function show($id){
            $parametro = TGParametro::find($id);
            if(is_null($parametro)){
                return response()->json('Record not found', 404);
            }
            return response()->json($parametro, 200);
    }
    public function update(Request $request, $id){
        $this->validate($request, [
            'tx_nombre' => 'required|string|max:255',
            'tx_abreviatura' => 'required|string|max:255',
            'nu_item' => 'required|integer',
            'dominio' => 'required|string|max:255',
        ]);
        $parametro = TGParametro::find($id);
        if(is_null($parametro)){
            return response()->json('Record not found', 404);
        }
        $parametro->update($request->all());
        return response()->json($parametro, 200);
    }
    public function destroy($id){
        $parametro = TGParametro::find($id);
        if(is_null($parametro)){
            return response()->json('Record not found', 404);
        }
        $parametro->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 204);
    }
}
