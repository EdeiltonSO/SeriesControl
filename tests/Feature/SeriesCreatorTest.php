<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\SeriesCreator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesCreatorTest extends TestCase
{
    use RefreshDatabase;

    public function testCriarSerie()
    {
        $criadorDeSerie = new SeriesCreator();
        $nomeSerie = 'Dark';
        $serie = $criadorDeSerie->criaSerie($nomeSerie, 3, 10);

        $this->assertInstanceOf(Serie::class, $serie);
        $this->assertDatabaseHas('series', ['nome' => $nomeSerie]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serie->id, 'numero' => 3]);
        $this->assertDatabaseHas('episodios', ['numero' => 10]);
    }
}
