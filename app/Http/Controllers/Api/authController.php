<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class authController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'cellphone' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60*24);
            return response(["token"=>$token], Response::HTTP_OK)->withCookie($cookie);
        } else {
            return response(["error" => "Las credenciales son invalidas, por favor validar."], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout()
    {
        $cookie = Cookie::forget('cookie_token');
        return response(["message" => "Sesión cerrada"], Response::HTTP_OK)->withCookie($cookie);
    }
}
