<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{
    public function login(Request $authRequest){

        $user = User::where('email', $authRequest->email)->first();
        
        if (! $user || ! Hash::check($authRequest->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        $token = $user->createToken($user->id)->plainTextToken;
    
        return response()->json([
            'access_token' => $token,
        ]);
    } 

    public function store(Request $request)
    {

        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Criação do usuário
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Usuário criado com sucesso'], 201);
    }
}
