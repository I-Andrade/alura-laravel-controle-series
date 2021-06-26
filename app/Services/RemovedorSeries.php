<?php


namespace App\Services;


use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorSeries
{
    public function remover(Serie $serie) : void
    {
        DB::transaction(function () use ($serie) {
            $this->removerSerie($serie);
        });
    }

    private function removerSerie(Serie $serie): void
    {
        $this->removerTemporadas($serie);
        $serie->delete();
    }

    private function removerTemporadas(Serie $serie): void
    {
        $serie->temporadas()->each(
            function (Temporada $temporada) {
                $this->removerEpisodios($temporada);
                $temporada->delete();
            });
    }

    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(
            function (Episodio $episodio) {
                $episodio->delete();
            });
    }
}
