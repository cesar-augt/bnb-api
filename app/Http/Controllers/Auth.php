<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class Auth extends Controller
{
    public function login(LoginRequest $request){
        $request->validated();
        $user = User::where('email', $request->email)->first();
        
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        
        $token = $user->createToken($user->id)->plainTextToken;
    
        return response()->json([
            'access_token' => $token,
        ]);
    } 

    public function store(UserStoreRequest $request)
    {
        $request->validated();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        return $user->save();
    }
}
