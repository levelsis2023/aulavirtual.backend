<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institucion;

class InstitucionesController extends Controller
{
    protected $domain_id;

    public function __construct(Request $request)
    {
        $this->domain_id = $request->attributes->get('domain_id');
    }
    
    public function index()
    {
        // Obtener todas las instituciones
        $instituciones = Institucion::orderBy('id', 'desc')->get();
        return response()->json($instituciones);
    }

    public function store(Request $request)
    {
        // Validar y crear una nueva institución
        $validatedData = $request->validate([
            'nombre'      => 'required|string|max:191',
            'siglas'      => 'required|string|max:191',
            'director'    => 'required|string|max:191',
            'logotipo'    => 'string|max:191',
            'color_fondo' => 'string|max:20',
            'color_texto' => 'string|max:20'
            //'domain_id' => 'nullable|exists:domains,id', // Si tienes una tabla domains
        ]);

        $institucion = Institucion::create($validatedData);
        return response()->json($institucion, 201);
    }

    public function show($id)
    {
        // Mostrar una institución específica
        $institucion = Institucion::findOrFail($id);
        return response()->json($institucion);
    }

    public function update(Request $request, $id)
    {
        // Validar y actualizar una institución
        // $validatedData = $request->validate([
        //     'nombre'      => 'required|string|max:191',
        //     'siglas'      => 'required|string|max:191',
        //     'director'    => 'required|string|max:191',
        //     'logotipo'    => 'string|max:191',
        //     'color_fondo' => 'string|max:20',
        //     'color_texto' => 'string|max:20'
        //     //'domain_id' => 'nullable|exists:domains,id', // Si tienes una tabla domains
        // ]);

        // $institucion = Institucion::findOrFail($id);
        // $institucion->update($validatedData);
        // return response()->json($institucion);
        return response()->json(['message' => ' encontrado'], 200);
    }

    public function destroy($id)
    {
        // Eliminar una institución
        $institucion = Institucion::findOrFail($id);
        $institucion->delete();
        return response()->json(null, 204);
    }
}
