<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegislacaoController extends Controller
{
    public function index(Request $request)
    {
        $dados = [];
        $path = 'docs/legislacao/';
        $diretorio = dir($path);

        while ($arquivo = $diretorio->read()) {
            array_push($dados, $arquivo);
        }
        $diretorio->close();
        return response()->json(['arquivos' => $dados]);
    }
}
