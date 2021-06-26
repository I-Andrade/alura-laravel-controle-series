<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadorSeries;
use App\Services\RemovedorSeries;
use App\Temporada;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        //$series = Serie::all();
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        return view('series.index', ['series' => $series, 'mensagem' => $mensagem]);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorSeries $criadorSeries)
    {
        $serie = $criadorSeries->criar($request->nome, $request->temporadas, $request->episodios);
        $mensagem = "Série com id {$serie->id} criada com sucesso: {$serie->nome}";
        $request->session()->flash('mensagem', $mensagem);
        return redirect()->route('series.index');
    }

    public function destroy(Request $request, RemovedorSeries $removedorSeries)
    {
        $serie = Serie::find($request->id);
        $removedorSeries->remover($serie);
        $mensagem = "Série $serie->nome com removida com sucesso";
        $request->session()->flash('mensagem', $mensagem);
        return redirect()->route('series.index');
    }

    public function editarNome(int $id, Request $request)
    {
        $serie = Serie::find($id);
        $serie->nome = $request->nome;
        $serie->save();
    }
}
