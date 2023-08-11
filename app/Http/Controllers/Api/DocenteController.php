<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AtributosDocentes;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocenteController extends Controller
{

    public function index()
    {
        //
    }


    public function registerDocente(Request $request){
        
        
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
        $user->assignRole('Docente');

        $atributosDocentes = new AtributosDocentes();

        

        return response($user, Response::HTTP_CREATED);


    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
