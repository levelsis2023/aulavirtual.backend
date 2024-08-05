<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\UserTrait;

class UsuarioController extends Controller
{
    use UserTrait;
    public function index(){
        $usuarios=DB::table('users')->select('name','email','nombre')->join('rol','users.rol_id','=','rol.id')->get();
        return $usuarios;
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'dni' => 'required|string|max:255',
            'rol_id' => 'required|integer',
            'domain_id' => 'required|integer',
        ]);
        $isValidEmail=$this->checkIsValidEmail($request->input('email'));
        if(!$isValidEmail){
            return response()->json(['message' => 'Email en uso'], 400);
        }
         DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->email),
            'dni' => $request->dni,
            'rol_id' => $request->rol_id,
            'domain_id' => $request->domain_id,
        ]);

        return response()->json(['status'=>true]);

    }
}
