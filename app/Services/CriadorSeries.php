<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\{Serie};

class CriadorSeries
{
    public function criar(string $nome_serie, int $qtd_temporadas, int $qtd_episodios) : Serie
    {
        $serie = new Serie();
        DB::transaction(function () use (&$serie, $nome_serie, $qtd_temporadas, $qtd_episodios)
            {
                $serie = $this->criarSerie($nome_serie, $qtd_temporadas, $qtd_episodios);
            }
        );
        return $serie;
    }

    private function criarSerie(string $nome_serie, int $qtd_temporadas, int $qtd_episodios)
    {
        $serie = Serie::create(['nome' => $nome_serie]);
        $this->criarTemporadas($qtd_temporadas, $serie, $qtd_episodios);
        return $serie;
    }


    private function criarTemporadas(int $qtd_temporadas, $serie, int $qtd_episodios): void
    {
        for ($i = 1; $i <= $qtd_temporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criarEpisodio($qtd_episodios, $temporada);
        }
    }


    private function criarEpisodio(int $qtd_episodios, $temporada): void
    {
        for ($j = 1; $j <= $qtd_episodios; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
