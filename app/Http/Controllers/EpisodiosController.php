<?php

namespace App\Http\Controllers;

use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    // depende do parâmetro temporada na rota '/temporadas/{temporada}/episodios'
    public function index(Temporada $temporada)
    {
        $episodios = $temporada->episodios;
        return view('episodios.index', compact('episodios'));
    }
}
