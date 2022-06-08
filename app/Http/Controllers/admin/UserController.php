<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function store(UserRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        try {
            User::create($data);
            return response()->json(['success' => 'Usuário criado com suceso!'], 200);
        } catch (Exception $error) {
            dd($error);
            return response()->json(['error' => 'Erro ao criar usuário!'], 400);
        }
    }

    public function show($uuid)
    {
            $user = User::where('uuid', $uuid)->get()->first();
            
            if (!$user) {
                return response()->json(['error' => 'O usuário não existe!'], 404);
            }

            return $user;
        }

    public function update(UserRequest $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->get()->first();
            
        if (!$user) {
            return response()->json(['error' => 'O usuário não existe!'], 404);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        try {
            $user->fill($data);
            $user->save();
            return response()->json(['success' => 'O usuário foi editado com sucesso!'], 200);
        } catch (Exception) {
            return response()->json(['error' => 'erro ao editar usuário!'], 400);
        }
    }

    public function destroy($uuid)
    {
        $user = User::where('uuid', $uuid)->get()->first();

        if (!$user) {
            return response()->json(['error' => 'O usuário não existe!'], 404);
        }

        $user->delete();
        return response()->json(['success' => 'O usuário foi excluído com sucesso!'], 200);
    }
}
