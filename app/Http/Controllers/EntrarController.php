<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrarController extends Controller
{
    public function index() {
        return view('entrar.index');
    }

    // attempt recebe os dados pra buscar o usuário no banco
    // e faz o login, salvando os dados do usuário na sessão
    public function entrar(Request $req) {
        if (!Auth::attempt($req->only(['email', 'password']))) {
            return redirect()->back()->withErrors('Dados incorretos!');
        }
        return redirect()->route('listar_series');
    }
}
