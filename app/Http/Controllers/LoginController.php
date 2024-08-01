<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        //check if the user is in the database 
        $user = DB::table('users')->where('email', $request->email)->first();
        if(!$user){
            return response()->json(
                ['mensaje' => 'Usuario no encontrado','status'=>404], 200);
        }
        if(Hash::check($request->password, $user->password)){
            return response()->json(['mensaje' => 'Usuario autenticado','status'=>200
            ,'user'=>$user
        ], 200);
        }else{
            return response()->json(['mensaje' => 'Contraseña incorrecta','status'=>404], 200);
        }
    }
}
