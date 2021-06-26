@extends('layout')

@section('cabecalho')
    Série: {{$serie->nome}} > Temporadas
@endsection

@section('conteudo')

    <ul class="list-group">
        <?php foreach ($temporadas as $temporada): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <a href="/series/{{$serie->id}}/{{$temporada->id}}" class="href">Temporada <?= $temporada->numero ?></a>
            </div>
            <span class="badge badge-secondary">
                {{$temporada->getEpisodiosAssistidos()->count()}} /
                {{$temporada->episodios->count()}}</span>
        </li>
        <?php endforeach; ?>
    </ul>
@endsection





