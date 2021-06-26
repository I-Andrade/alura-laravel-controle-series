<?php

namespace Tests\Unit;

use App\Serie;
use App\Services\CriadorSeries;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CriadorDeSerieTest extends TestCase
{

    use RefreshDatabase;

    public function testCriarSerie()
    {
        $criadorDeSerie = new CriadorSeries();
        $serie = $criadorDeSerie->criar("Teste12", 1, 1);

        $this->assertInstanceOf(Serie::class, $serie);
        $this->assertDatabaseHas('series', ['nome'=> "Teste12"]);
        $this->assertDatabaseHas('temporadas', ['serie_id'=> $serie->id, 'numero' => 1]);
        $this->assertDatabaseHas('episodios', ['numero' => 1]);
    }
}
