<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');

    try {
      if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Credenciais inválidas'], 401);
      }
    } catch (JWTException $e) {
      return response()->json(['error' => 'Não foi possível criar o token'], 500);
    }

    return response()->json(compact('token'));
  }
}
