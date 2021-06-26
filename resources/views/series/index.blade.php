@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')

    @include('mensagem', ['mensagem' => $mensagem])

    <a href={{route('series.create')}} class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        <?php foreach ($series as $serie): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span id="nome-serie-{{$serie->id}}"> <?= $serie->nome ?> </span>

            <div class="input-group w-50" hidden id="edit-serie-{{$serie->id}}">
                <input type="text" class="form-control" value="{{ $serie->nome }}">
                <div class="input-group-append">
                    <button class="btn btn-info btn-sm mr-2" onclick="editarSerie({{ $serie->id }})">OK</button>
                    @csrf
                </div>
            </div>

            </span>

            <span class="d-flex">
                @auth
                <button class="btn btn-info btn-sm mr-2" onclick="toggleInput({{$serie->id}})">
                    Editar
                </button>
                @endauth

                <a href="/series/{{$serie->id}}/temporadas" class="btn btn-info btn-sm mr-2">Temporadas</a>

                @auth
                <form action="/series/{{$serie->id}}" method="post"
                      onsubmit="return confirm
                      ('Tem certeza que deseja remover a série: {{$serie->nome}} ?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
                @endauth

            </span>

        </li>

        <?php endforeach; ?>
    </ul>

    <script>
        function toggleInput(serieId){
            const nome = document.getElementById(`nome-serie-${serieId}`);
            const form = document.getElementById(`edit-serie-${serieId}`);
            if (nome.hasAttribute('hidden')) {
                nome.removeAttribute('hidden');
                form.hidden = true;
            } else {
                form.removeAttribute('hidden');
                nome.hidden = true;
            }
        }

        function editarSerie(serieId){
            const nomeAtualizar = document.getElementById(`nome-serie-${serieId}`);
            const nome = document.querySelector(`#edit-serie-${serieId} > input`).value;
            const token = document.querySelector(`input[name="_token"]`).value;
            let formData = new FormData;
            formData.append('nome', nome);
            formData.append('_token', token);
            const url = `/series/${serieId}/editarNome`;
            fetch(url, {
                method: 'POST',
                body: formData
            }).then(() => {
                nomeAtualizar.textContent = nome;
                toggleInput(serieId);
            });
        }
    </script>
@endsection





