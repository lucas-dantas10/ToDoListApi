<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\CreateLoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
        
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLoginRequest $request)
    {
        $data = $request->validated();

        $user = User::firstOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]
        );

        if (!$user->wasRecentlyCreated) {
            return response([
                'message' => 'Email já está sendo utilizado'
            ], 422);
        }

        return \response([
            'message' => 'Usuário cadastrado'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => ['max:100'],
            'password' => [Password::min(8)]
        ]);

        $user = User::findOrfail($id);

        if ($user->name == $data['name']) {
            return \response([
                'message' => 'Este nome já está sendo utilizado'
            ], 422);
        }

        if (!isset($data['password'])) {
            try {
                $user->update([
                    'name' => $data['name']
                ]);
                
                return \response([
                    'message' => 'Nome do usuário atualizado'
                ], 422);
            } catch (Exception $err) {
                throw new Exception($err->getMessage());
            }
            
        }

        if (Hash::check($data['password'], $user->password)) {
            return \response([
                'message' => 'Esta senha já está sendo utilizada'
            ], 422);
        }

        try {
            $user->update([
                'name' => $data['name'],
                'password' => $data['password'],
            ]);
    
            return \response([
                'message' => 'Nome e Senha atualizados'
            ]);
        } catch(Exception $err) {
            throw new Exception($err->getMessage());
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
        
    // }
}
