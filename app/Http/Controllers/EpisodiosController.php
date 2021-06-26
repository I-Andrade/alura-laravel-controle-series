<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Serie $serie, Temporada $temporada, Request $request)
    {
        $episodios = $temporada->episodios;
        $mensagem = $request->session()->get('mensagem');
        return view(
            'episodios.index',
            compact('serie', 'temporada', 'episodios', 'mensagem')
        );
    }

    public function assistir(Serie $serie, Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos) {
            $episodio->assistidos = in_array($episodio->id, $episodiosAssistidos);
        });

        $temporada->push();

        $mensagem = "Episódios marcados com sucesso";
        $request->session()->flash('mensagem', $mensagem);

        return redirect()->back();
    }
}
