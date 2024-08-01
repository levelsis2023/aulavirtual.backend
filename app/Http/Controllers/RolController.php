<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Rol;
use DateTime;
use App\Traits\CommonTrait;
class RolController extends Controller
{
    use CommonTrait;
    public function index()
    {
        $data = Rol::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
        ]);

        $rol = Rol::create([
            'nombre' => $request->nombre,
            'fecha' => new DateTime()
        ]);

        return response()->json($rol, 201);
    }

    public function show($id)
    {
        $data = Rol::find($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
        ]);

        $rol = Rol::find($id);
        $rol->nombre = $request->get('nombre');
        $rol->save();
        return response()->json($rol, 201);
    }

    public function destroy($id)
    {
        $rol = Rol::find($id);
        $rol->permisos()->detach();
        $rol->delete();

        return response()->json(['mensaje' => "Se eliminó el rol"], 200);
    }

    public function guardarPermiso(Request $request)
    {
        $idRol = $request->get('id');
        $idPermisos = $request->get('idPermisos',null);
        $rol = Rol::find($idRol);

        if ($idPermisos) {
            $rol->permisos()->detach();
            foreach ($idPermisos as $idpermiso)
                $rol->permisos()->attach($idpermiso);
        }else{
            $rol->permisos()->detach();
        }
        return response()->json(['mensaje' => "Se registraron los permisos"], 201);
    }

    public function getRolPermisos($id)
    {
        $rol = Rol::with('permisos')->find($id);
        if (!$rol) {
            return response()->json(['error' => 'Role not found'], 404);
        }
        return response()->json($rol->permisos,200);

    }
    public function getRolesDropDown()
    {
        $roles = $this->getRolesDropDownTrait();
        return response()->json($roles);
    }
}
