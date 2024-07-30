<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class AlumnoController extends Controller
{
    public function index(){
      $alumnos = Alumno::leftJoin('t_g_parametros as ciclo', 'ciclo.nu_id_parametro', '=', 'alumnos.ciclo_id')
          ->leftJoin('carreras', 'carreras.id', '=', 'alumnos.carrera_id')
          ->leftJoin('domains', 'domains.id', '=', 'alumnos.domain_id') 
              ->select(
                  'alumnos.*',
                  'ciclo.tx_abreviatura as ciclo_nombre',
                  'carreras.nombres as carrera_nombre',
                  'domains.nombre as institucion'
              )->
            whereNull('alumnos.deleted_at')->   get();
      return response()->json($alumnos);
    }
    public function store(Request $request){
        
        $this->validate($request, [
            'codigo' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'cicloId' => 'required|integer',
            'carreraId' => 'required|integer',
            'tipoDocumento' => 'required|integer|max:255',

        ]);
        $directories = [
            'public/carnet',
            'public/fotos'
        ];
        
        foreach ($directories as $directory) {
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
        }
        if ($request->hasFile('fotoCarnet')) {
            $file = $request->file('fotoCarnet');
            $path = $file->store('public/carnet');  // Almacena el archivo en el directorio 'public/carnet'
            $path = str_replace('public/', '', $path);  // Limpia el prefijo 'public/'
            $request->merge(['fotoCarnet' => $path]);
        }
        
        if ($request->hasFile('fotoPerfil')) {
            $file = $request->file('fotoPerfil');
            $path = $file->store('public/fotos');  // Almacena el archivo en el directorio 'public/fotos'
            $path = str_replace('public/', '', $path);  // Limpia el prefijo 'public/'
            $request->merge(['fotoPerfil' => $path]);
        }
        $alumno=[
            "codigo"=>$request->input('codigo'),
            "nombres"=>$request->input('nombres'),
            "apellidos"=>$request->input('apellidos'),
            "celular"=>$request->input('nroCelular'),
            "email"=>$request->input('email'),
            "carrera_id"=>$request->input('carreraId'),
            "ciclo_id"=>$request->input('cicloId'),
            "dni"=>$request->input('numeroDocumento'),
            "genero"=>"masculino",
            "foto_carnet"=>$request->input('fotoCarnet'),
            "foto_perfil"=>$request->input('fotoPerfil'),
            'fecha_nacimiento' => $request->input('fechaNacimiento'),   
            'direccion' => $request->input('direccion'),
            'domain_id' => $request->input('domain_id'),
            
        ];
        //if exists request->input('id') then update else insert
        if($request->input('id')){
            $alumno = DB::table('alumnos')->where('id', $request->input('id'))->first();
            if ($alumno) {
                $alumno = DB::table('alumnos')->where('id', $request->input('id'))->update(
                    [
                        "codigo"=>$request->input('codigo'),
                        "nombres"=>$request->input('nombres'),
                        "apellidos"=>$request->input('apellidos'),
                        "celular"=>$request->input('nroCelular'),
                        "email"=>$request->input('email'),
                        "carrera_id"=>$request->input('carreraId'),
                        "ciclo_id"=>$request->input('cicloId'),
                        "dni"=>$request->input('numeroDocumento'),
                        "genero"=>"masculino",
                        "foto_carnet"=>$request->input('fotoCarnet'),
                        "foto_perfil"=>$request->input('fotoPerfil'),
                        'fecha_nacimiento' => $request->input('fechaNacimiento'),   
                        'direccion' => $request->input('direccion'),
                        'domain_id' => $request->input('domain_id'),
                    ]
                );
                return response()->json("Record updated", 201);
            }
            return response()->json('Record not found', 404);
        }else{
            $alumno = DB::table('alumnos')->insert($alumno);

        }
        return response()->json($alumno, 201);
    }
    public function update(Request $request){
        //recibe formData

        $this->validate($request, [
            'codigo' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'cicloId' => 'required|integer',
            'carreraId' => 'required|integer',
            'dni' => 'required|string|max:255',
        ]);
        $dominio = $request->input('dominio');
        $alumno = Alumno::where('id', $id)->where('dominio', $dominio)->first();
        if ($alumno) {
            $alumno->update($request->all());
            return response()->json($alumno, 201);
        }
        return response()->json('Record not found', 404);
    }
    public function destroy($id, $dominio)
    {
        $alumno = Alumno::where('id', $id)->where('domain_id', $dominio)->first();
        if ($alumno) {
            $alumno->deleted_at = Carbon::now();
            $alumno->save();
            return response()->json('Record deleted', 201);
        }
        return response()->json('Record not found', 404);
    }
    public function show($id, $dominio){
        $carrera = Alumno::where('id', $id)->where('domain_id', $dominio)->first();
        if ($carrera) {
            return response()->json($carrera);
        }
        return response()->json('Record not found', 404);
    }
}
