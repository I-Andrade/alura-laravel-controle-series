<?php

namespace Tests\Unit;

use App\Episodio;
use App\Temporada;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemporadaTest extends TestCase
{
    /**
     * @var Temporada
     */
    private $temporada;



    //cria cenário que é executado antes de cada teste
    protected function setUp() : void
    {
        parent::setUp();
        $temporada = new Temporada();
        $episodio1 = new Episodio();
        $episodio1->assistidos = true;
        $episodio2 = new Episodio();
        $episodio2->assistidos = false;
        $episodio3 = new Episodio();
        $episodio3->assistidos = true;
        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;
    }

    public function testCountGetEpisodiosAssistidos()
    {

        $episodiosAssistidos =  $this->temporada->getEpisodiosAssistidos();
        $this->assertCount(2, $episodiosAssistidos);

    }

    public function testAssistidoGetEpisodiosAssistidos()
    {

        $episodiosAssistidos =  $this->temporada->getEpisodiosAssistidos();
        foreach ($episodiosAssistidos as $episodio){
            $this->assertTrue($episodio->assistidos);
        }


    }

}
