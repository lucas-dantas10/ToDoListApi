<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\CreateLoginRequest;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return \response([
                "message" => "Usuário ou Senha está incorreto"
            ], 422);
        }

        $user = $request->user();

        $token = $user->createToken('main');

        return response([
            'token' => $token->plainTextToken,
            'user' => new UserResource($user)
        ]);        
    }

    public function logout()
    {
        $user = auth()->user();

        $user->currentAccessToken()->delete();

        return response()->noContent();
        // \dd('LOGOUT');
    }

    public function getCurrentUser()
    {
        $user = Auth::user();

        return new UserResource($user);
    }
}
