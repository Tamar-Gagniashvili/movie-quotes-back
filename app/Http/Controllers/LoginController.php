<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user=User::where('email', $request->email)->first();
       
        if ($user && Hash::check(request('password'), $user->password)) {
            auth()->login($user);
            return ["success"=>"You are logged in"];
        } else {
            return ["error"=>"Your provided credentials could not be verified."];
        };
    
        $token = $user->createToken('my-app-token')->plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token
        ];
        
        return response($response, 201);
    }

    public function logout()
    {
        auth()->logout();

        return ['success'=>'You are logged out'];
    }
}
