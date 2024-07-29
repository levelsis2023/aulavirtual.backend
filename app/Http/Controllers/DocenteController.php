<?php

namespace App\Http\Controllers;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class DocenteController extends Controller
{
    public function index(Request $request)
    {
        $docente = Docente::all();
        foreach($docente as $item){
            // Obtén el contenido del archivo y el tipo MIME
            $fileContent = file_get_contents($item->foto);
            $mimeType = mime_content_type($item->foto);

            // Convierte el contenido a Base64
            $base64Content = base64_encode($fileContent);
            
            // Agrega el tipo MIME al principio de la cadena Base64
            $item->foto = 'data:' . $mimeType . ';base64,' . $base64Content;
        }        
        return response()->json(['Exito' => true, 'Datos' => $docente], 200);
    }

    public function imagen(Request $request)
    {
        $base64Image = $request->input('base64');
        if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
            return response()->json(['Error' => true, 'Mensaje' => 'Imagen inválida']);
        }
        $imageType = $matches[1];
        $base64Image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
        $image = base64_decode($base64Image);
        
        // Generar un nombre único para el archivo
        $imageName = uniqid() . '.' . $imageType;

        // Definir la ruta donde se guardará la imagen
        $imagePath = storage_path('app\\public\\docentes\\' . $imageName);

        // Crear el directorio si no existe
        if (!file_exists(dirname($imagePath))) {
            mkdir(dirname($imagePath), 0777, true);
        }

        // Guardar la imagen en el disco
        file_put_contents($imagePath, $image);
        return response()->json($imagePath);
    }

    public function show($id)
    {
        $docente = Docente::find($id);
        if(!$docente){
            return response()->json(['Error' => 'Docente no encontrado'], 404);
        }

        return response()->json(['Exito' => true, 'Datos' => $docente], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|string|max:20',
            'nombres' => 'required|string|max:20',
            'usuario' => 'required|string|max:20',
            'clave' => 'required|string|max:30',
            'celular' => 'required|string|max:20',
            'profesion' => 'required|string|max:30',
            'vinculo_laboral' => 'required|string|max:20',
            'tipo_documento' => 'required|string|max:20',
            'doc_identidad' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|date|before:today',
            'edad' => 'required|integer|min:18',
            'genero' => 'required|string|max:100',
            // 'foto' => 'required|string|max:100'
        ]);
        if($validator->fails()){
            return response()->json(['Error' => $validator->errors()], 422);
        }

        $base64Image = $request->input('foto');
        if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
            return response()->json(['Error' => true, 'Mensaje' => 'Imagen inválida']);
        }
            $imageType = $matches[1];
            $base64Image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
            $image = base64_decode($base64Image);
            
            // Generar un nombre único para el archivo
            $imageName = uniqid() . '.' . $imageType;

            // Definir la ruta donde se guardará la imagen
            $imagePath = storage_path('app\\public\\docentes\\' . $imageName);

            // Crear el directorio si no existe
            if (!file_exists(dirname($imagePath))) {
                mkdir(dirname($imagePath), 0777, true);
            }

            // Guardar la imagen en el disco
            file_put_contents($imagePath, $image);

            $docente = Docente::create([
                "codigo" => $request->codigo,
                "nombres"=> $request->nombres,
                "usuario"=> $request->usuario,
                "clave"=> $request->clave,
                "celular"=> $request->celular,
                "profesion"=> $request->profesion,
                "vinculo_laboral"=> $request->vinculo_laboral,
                "tipo_documento"=> $request->tipo_documento,
                "doc_identidad"=> $request->doc_identidad,
                "fecha_nacimiento"=> $request->fecha_nacimiento,
                "edad"=> $request->edad,
                "genero"=> $request->genero,
                "foto"=> $imagePath
            ]);
            return response()->json(['Exito' => true, 'Mensaje' => 'Registro exitoso'], 201);

    }

    public function update(Request $request, $id){
        $docente = Docente::find($id);
        if(!$docente){
            return response()->json(['Error' => 'Docente no encontrado'], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'codigo' => 'required|string|max:20',
            'nombres' => 'required|string|max:20',
            'usuario' => 'required|string|max:20|unique:docentes,usuario,'.$id,
            'clave' => 'required|string|max:30',
            'celular' => 'required|string|max:20',
            'profesion' => 'required|string|max:30',
            'vinculo_laboral' => 'required|string|max:20',
            'tipo_documento' => 'required|string|max:20',
            'doc_identidad' => 'required|string|max:20|unique:docentes,doc_identidad,' .$id,
            'fecha_nacimiento' => 'required|date|before:today',
            'edad' => 'required|integer|min:18',
            'genero' => 'required|string|max:100',
            // 'foto' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json(['Error' => $validator->errors()], 422);
        }

        $base64Image = $request->input('foto');
        if (!preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
            return response()->json(['Error' => true, 'Mensaje' => 'Imagen inválida']);
        }

        $imageType = $matches[1];
        $base64Image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
        $image = base64_decode($base64Image);
        
        // Generar un nombre único para el archivo
        $imageName = uniqid() . '.' . $imageType;

        // Definir la ruta donde se guardará la imagen
        $imagePath = storage_path('app\\public\\docentes\\' . $imageName);

        // Crear el directorio si no existe
        if (!file_exists(dirname($imagePath))) {
            mkdir(dirname($imagePath), 0777, true);
        }

        // Guardar la imagen en el disco
        file_put_contents($imagePath, $image);


        $docente->update([
            "codigo" => $request->codigo,
            "nombres"=> $request->nombres,
            "usuario"=> $request->usuario,
            "clave"=> $request->clave,
            "celular"=> $request->celular,
            "profesion"=> $request->profesion,
            "vinculo_laboral"=> $request->vinculo_laboral,
            "tipo_documento"=> $request->tipo_documento,
            "doc_identidad"=> $request->doc_identidad,
            "fecha_nacimiento"=> $request->fecha_nacimiento,
            "edad"=> $request->edad,
            "genero"=> $request->genero,
            "foto"=> $imagePath
        ]);

        return response()->json(['Exito' => true, 'Mensaje' => 'Docente actualizado correctamente'], 200);
    }

    public function destroy($id){
        $docente = Docente::find($id);
        if(!$docente){
            return response()->json(['Error' => 'Docente no encontrado'], 404);
        }
        $docente->delete();
        return response()->json(['Mensaje' => 'Docente Eliminado'], 200);
    }
}
