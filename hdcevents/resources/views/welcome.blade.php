
@extends('layouts.main')
@section('title','Cursos')
@section('content')


<div id="search-container" class="col-md-12">
    <h1>Busque um curso que deseja</h1>

    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)

    <h2>Buscando por: {{$search}}</h2>
    @else
    <h2>Cursos Disponíveis</h2>
    <p class="subtitle">Veja os eventos dos próximos dias</p>
    @endif
    
    <div id="cards-container" class="row">
    @foreach($cursos as $curso)
        <div class="card col-md-3">
            <img src="/imagens/events/{{$curso->imagemCurso}}" alt="{{ $curso->nomeCurso }}">
            <div class="card-body">
                <p class="card-date">{{date('d/m/y', strtotime($curso->data)) }}</p>
                <h5 class="card-title">{{ $curso->nomeCurso }}</h5>
                <p class="card-participants">{{count($curso->users)}} Participantes</p>
                <a href="/events/{{$curso->id}} " class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach
        @if(count($cursos)==0)
            <p>Não há cursos Disponíveis</p>
        @endif
    </div>
</div>

@endsection