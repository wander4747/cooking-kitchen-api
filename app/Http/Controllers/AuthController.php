<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
      
        if (!Auth::attempt($data)) {
            return response()->json('E-mail ou senha incorretos!', 401);
        }
      
        $user = Auth::user();
        $token = $user->createToken('JWT');
      
        return response()->json($token->plainTextToken, 200);
    }
}
