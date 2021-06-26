<?php

namespace Tests\Unit;

use App\Services\CriadorSeries;
use App\Services\RemovedorSeries;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorSerieTest extends TestCase
{

    use RefreshDatabase;

    private $removedor;
    private $serie;

    protected function setUp(): void
    {
        parent::setUp();
        $criador = new CriadorSeries();
        $serie = $criador->criar('Teste15', 2, 2);
        $this->serie = $serie;
        $removedor = new RemovedorSeries();
        $this->removedor = $removedor;

    }

    public function testExample()
    {
        $this->assertDatabaseHas('series', ['nome'=>'Teste15']);

        $this->assertEquals('Teste15', $this->serie->nome);
        $this->assertEquals(2, $this->serie->temporadas->count());
        foreach ($this->serie->temporadas as $temporada) {
            $this->assertEquals(2, $temporada->episodios->count());
        }

        $this->removedor->remover($this->serie);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);

    }
}
