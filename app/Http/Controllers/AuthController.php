<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciales = $request->only('email','password');

        try {
            if(!$token = \JWTAuth::attempt($credenciales)){
                return response()->json([
                    'msj' => 'Datos Incorrectos. '
                ], 401);
                Log::info('Token Creado');
            }
        }catch (JWTException $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json([
                'msj' => 'Error al intentar crear el token. Intente de nuevo'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'token' => $token,
            'user' => \JWTAuth::toUser($token)
        ], 200);
    }

    public function logout()
    {
        try{
            \JWTAuth::invalidate(\JWTAuth::getToken());
            return response()->json([
                'msj' => 'success logout exit.'
            ], 200);
            Log::info("Token invalidado satisfactoriamente");
        }catch (JWTException $e){
            Log::critical("Error, archivo del peo: {$e->getFile()}, linea del peo: {$e->getLine()}, el peo: {$e->getMessage()}");
            return response()->json([
                'msj' => 'Error al intentar olvidar token'
            ], 500);
        }


    }

    public function validate()
    {
        try{
            if(!$user = \JWTAuth::parseToken()->authenticate())
                return response()->json([
                    'msj' => 'Usuario no Encontrado'
                ], 404);
        }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            return response()->json([
                'msj' => 'Usuario no Encontrado'
            ], $e->getStatusCode());
        }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            return response()->json([
                'msj' => 'Token Invalido'
            ], $e->getStatusCode());
        }catch (\Tymon\JWTAuth\Exceptions\JWTException $e){
            return response()->json([
                'msj' => 'Token Inexistente'
            ], $e->getStatusCode());
        }
        return response()->json([
            'status' => true,
            'user' => $user
        ], 20);
    }

}
