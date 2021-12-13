<?php

namespace App\Services;

use App\Models\{ Serie, Temporada, Episodio };
use Illuminate\Support\Facades\DB;

class SeriesRemover
{
    public function removeSerie(string $serieId): string
    {
        $nomeSerie = '';

        DB::transaction(function() use ($serieId, &$nomeSerie) {
            // encontrando série no banco
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            // excluindo relações com temporada e episódio
            $serie->temporadas->each(function (Temporada $temporada) {
                $temporada->episodios->each(function (Episodio $episodio) {
                    $episodio->delete();
                });
                $temporada->delete();
            });
            $serie->delete();
        });

        return $nomeSerie;
    }
}
