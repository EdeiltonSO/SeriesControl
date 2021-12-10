<?php

namespace App\Services;

use App\Models\Serie;

class SeriesCreator
{
    public function criaSerie(string $nomeSerie, int $nTemporadas, int $epPorTemporada): Serie
    {
        $serie = Serie::create(['nome' => $nomeSerie]);
        $qtdTemporadas = $nTemporadas;
        $epPorTemporada = $epPorTemporada;

        for($i = 1; $i <= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ($j = 1; $j <= $epPorTemporada; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }

        return $serie;
    }
}
