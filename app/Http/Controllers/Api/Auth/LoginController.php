<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return response()->json(['role' => 'admin', 'token' => $user->createToken('Personal Access Token')->accessToken,'user'=>LoginResource::make($user)]);
            } else {
                return response()->json(['role' => 'user', 'token' => $user->createToken('Personal Access Token')->accessToken,'user'=>LoginResource::make($user)]);
            }
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
