<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        // Check if the user is in the database
        $user = DB::table('users')->where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['mensaje' => 'Usuario no encontrado', 'status' => 404], 200);
        }

        if (Hash::check($request->password, $user->password)) {
            // Generate API token
            $apiToken = Str::random(150);

            // Update user with new API token
            DB::table('users')->where('id', $user->id)->update(['api_token' => $apiToken]);

            // Add the API token to the user object
            $user->api_token = $apiToken;

            return response()->json(['mensaje' => 'Usuario autenticado', 'status' => 200, 'user' => $user], 200);
        } else {
            return response()->json(['mensaje' => 'Contraseña incorrecta', 'status' => 404], 200);
        }
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'api_token' => 'required|string',
        ]);

        // Invalidate the API token
        $user = DB::table('users')->where('api_token', $request->api_token)->first();
        if ($user) {
            DB::table('users')->where('id', $user->id)->update(['api_token' => null]);
            return response()->json(['mensaje' => 'Usuario desconectado', 'status' => 200], 200);
        } else {
            return response()->json(['mensaje' => 'Token inválido', 'status' => 404], 200);
        }
    }
}
