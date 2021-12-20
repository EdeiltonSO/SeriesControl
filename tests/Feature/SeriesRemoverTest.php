<?php

namespace Tests\Feature;

use App\Services\SeriesCreator;
use App\Services\SeriesRemover;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRemoverTest extends TestCase
{
    use RefreshDatabase;

    private $serie; //$this->serie
    protected function setUp(): void
    {
        parent::setUp();
        $criadorDeSerie = new SeriesCreator();
        $this->serie = $criadorDeSerie->criaSerie('Dark', 3, 10);

    }

    public function testRemoverSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
        $removedorDeSerie = new SeriesRemover();
        $nomeSerie = $removedorDeSerie->removeSerie($this->serie->id);
        $this->assertIsString($nomeSerie);
        $this->assertEquals('Dark', $nomeSerie);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
