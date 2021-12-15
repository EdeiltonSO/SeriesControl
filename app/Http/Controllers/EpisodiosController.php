<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    // depende do parâmetro temporada na rota '/temporadas/{temporada}/episodios'
    public function index(Temporada $temporada, Request $req)
    {
        return view('episodios.index', [
            'episodios' => $temporada->episodios,
            'temporadaId' => $temporada->id,
            'mensagem' => $req->session()->get('mensagem')
        ]);
    }

    public function assistir(Temporada $temporada, Request $req)
    {
        $episodiosAssistidos = $req->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos) {
            $episodio->assistido = in_array($episodio->id, $episodiosAssistidos);
        });
        $temporada->push();

        $req->session()->flash('mensagem', 'Episódios marcados como assistidos');

        return redirect()->back();
    }
}
