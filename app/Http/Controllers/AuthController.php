<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->all();
        $user_info = \App\Models\User::where('email', '=', $credenciais)->get(['id', 'email', 'name', 'ch_equipe_name', 'ch_equipe_pg', 'post_grad', 'userType', 'om', 'local_assinatura']);
        $token = auth('api')->attempt($credenciais);

        if ($token) {
            return response()->json(['token' => $token, 'user' => $user_info]);
        } else {
            return response()->json(['erro' => 'Usuário ou senha errado'], 403);
        }
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['msg' => 'Logout realizado']);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function register(Request $request)
    {
        $data = $request->all();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'post_grad' => $data['post_grad'],
            'ch_equipe_name' => $data['ch_equipe_name'],
            'ch_equipe_pg' => $data['ch_equipe_pg'],
            'om' => $data['om'],
            'local_assinatura' => $data['local_assinatura'],
        ]);
    }
}
