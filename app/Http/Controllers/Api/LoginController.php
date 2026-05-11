<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credenciales = $request->only('email', 'password');

        if (! $token = Auth::guard('api')->attempt($credenciales)) {
            return response()->json(['mensaje' => 'Datos incorrectos'], 401);
        }

        return response()->json([
            'token' => $token,
            'tipo' => 'Bearer',
            'expira_en' => '1 hora' 
        ]);
    }
}