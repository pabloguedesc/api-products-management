<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class VerifyJWTToken
{
  public function handle($request, Closure $next)
  {
    try {
      JWTAuth::parseToken()->authenticate();
    } catch (JWTException $e) {
      return response()->json(['error' => 'Token inválido'], 401);
    }

    return $next($request);
  }
}
