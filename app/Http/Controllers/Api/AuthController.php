<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\CreateLoginRequest;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Resources\User\UserResource;
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

        // $remember = $credentials['remember'] ?? false

        if (!Auth::attempt($credentials)) {
            return \response([
                "message" => "Usuário ou Senha incorreto"
            ]);
        }

        $user = $request->user();

        $token = $user->createToken('main');

        return response([
            'token' => $token->plainTextToken,
            'user' => new UserResource($user)
        ]);        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLoginRequest $request)
    {
        $data = $request->validated();
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
