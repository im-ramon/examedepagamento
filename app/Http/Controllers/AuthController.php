<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->all();
        $user_info = \App\Models\User::where('email', '=', $credenciais)->get(['email', 'name', 'ch_equipe_name', 'ch_equipe_pg', 'post_grad', 'userType', 'data_assinatura', 'om', 'local_assinatura']);
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
}
