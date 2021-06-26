@extends('layout')

@section('cabecalho')
    Série: {{$serie->nome}} > Temporada {{$temporada->numero}}
@endsection

@section('conteudo')

    @include('mensagem', ['mensagem' => $mensagem])

    <form action="/series/{{$serie->id}}/{{$temporada->id}}" method="Post">
        @csrf
        <ul class="list-group">
            <?php foreach ($episodios as $episodio): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    Episódio <?= $episodio->numero ?>
                </div>
                <span class="badge badge-secondary">

                    <input type="checkbox"
                           name="episodios[]"
                           @guest
                           disabled="disabled"
                           @endguest
                           value="{{$episodio->id}}"
                           {{ $episodio->assistidos ? 'checked' : ''}}>

                </span>
            </li>
            <?php endforeach; ?>
        </ul>
        @auth
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
        @endauth
    </form>
@endsection



