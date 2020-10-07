<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            //'email' => 'required|email|unique:users,email,'.$user->id,
            'email'=>'required|email|unique:users',
            'password' => 'required|min:9|regex:/(?=[A-Za-z0-9@#$%^&+!=]+$)^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+!=])(?=.{8,}).*$/',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);
        return response()->json([
            'res' => true,
            'message' => 'Usuario creado correctamente'
        ], 200); 
    }

    public function login(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if (!is_null($user) && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('contactos')->accessToken;
            return response()->json(['res' => true, 'token' => $token, 'message' => "Bienvenido al sistema"]);
        } else
            return response()->json(['res' => false, 'message' => "Cuenta a password incorrectos"]);
    }

    public function logout(){
        $user = auth()->user();
        $user->tokens->each(function ($token, $key){
            $token->delete();
        });
        return response()->json(['res' => true, 'message' => "Adios"]);
    }
}
