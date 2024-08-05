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
        $usuarios=DB::table('users')->select('users.id','name','email','nombre')->join('rol','users.rol_id','=','rol.id')->get();
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
            'password' => Hash::make($request->password),
            'dni' => $request->dni,
            'rol_id' => $request->rol_id,
            'domain_id' => $request->domain_id,
        ]);

        return response()->json(['status'=>true]);

    }
    public function destroy($id){
        //check if user exists and is not superadmin and if exists 
        // if has a docente_id or alumno_id 
        //delete row in docentes or alumnos
        //delete user
        $user=DB::table('users')->where('id',$id)->first();
        if(!$user){
            return response()->json(['status'=>false,'message'=>'Usuario no encontrado'],404);
        }
        if($user->rol_id==1){
            return response()->json(['status'=>false,'message'=>'No se puede eliminar el superadmin'],400);
        }
        if($user->docente_id){
            DB::table('docentes')->where('id',$user->docente_id)->delete();
        }
        if($user->alumno_id){
            DB::table('alumnos')->where('id',$user->alumno_id)->delete();
        }

        DB::table('users')->where('id',$id)->delete();
        return response()->json(['status'=>true]);
    }
}
