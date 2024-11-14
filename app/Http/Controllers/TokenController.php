<?php

namespace App\Http\Controllers;

use App\Models\User; // Aquí usas el modelo User que ya existe
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function generateToken()
    {
        // Aquí puedes usar el modelo User para obtener o crear un usuario
        $user = User::firstOrCreate([
            'email' => 'servicio@example.com'
        ], [
            'name' => 'Usuario de Servicio',
            'password' => bcrypt('password123') // Contraseña segura
        ]);

        // Genera el token para el usuario
        $token = $user->createToken('token-servicio')->plainTextToken;

        // Retorna el token en formato JSON
        return response()->json(['token' => $token]);
    }
}
