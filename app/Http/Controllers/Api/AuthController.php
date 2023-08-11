<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function registerEstudiante(Request $request){
        
        
        // $request->validate([
        // 'name' => 'required',
        // 'appaterno' => 'required',
        // 'apmaterno'=> 'required',
        // 'CI' => 'required|CI|unique:users',
        // 'Celular' => 'required',
        // 'email' => 'required|email|unique:users',
        // 'fechadenac' => 'required',
        // ]);
        
        
        
        $user = new User();
        $user->name = $request->name;
        $user->appaterno = $request->appaterno;
        $user->apmaterno = $request->apmaterno;
        $user->CI = $request->CI;
        $user->Celular = $request->Celular;
        $user->email = $request->email;
        $user->fechadenac = $request->fechadenac;
        $user->password = bcrypt(substr($request->name,0,1).substr($request->lastname1,0,1).substr($request->lastname2,0,1).$request->CI);
        $user->save();
        $user->assignRole('Estudiante');
        return response($user, Response::HTTP_CREATED);
    }


    public function login(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'], 
            'password' => ['required']]);
            
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $request->user()->createToken('token')->plainTextToken; 
            $cookie = cookie('cookie_token', $token, 60 * 24);
        return response(["token"=>$token], Response::HTTP_OK)->withoutCookie($cookie); } else {
        return response (Response::HTTP_UNAUTHORIZED);
        }
    }

    public function UserProfile(Request $request){
        return response()->json([
            "message" => "userProfile OK",
            "userData" => auth()->user(),
            "Rol" => Auth::user()->roles->pluck('name') 
        ],
        Response::HTTP_OK
    );


    } 
    
    public function logout(){
        $cookie = Cookie::forget('cookie_token');
        return response(["message" => "Cerro Sesión"], Response::HTTP_OK)->withCookie($cookie);

    }

}
