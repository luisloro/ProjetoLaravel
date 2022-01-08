@extends('layouts.main')
@section('title',$curso->nomeCurso)
@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
      <div id="image-container" class="col-md-6">
        <img src="/imagens/events/{{ $curso->imagemCurso }}" class="img-fluid" alt="{{ $curso->nomeCurso }}">
      </div>
      <div id="info-container" class="col-md-6">
        <h1>{{ $curso->nomeCurso }}</h1>
        <p class="event-city"><ion-icon name="location-outline"></ion-icon>Professor : {{ $curso->nomeProfessor }}</p>
        <p class="events-participants"><ion-icon name="people-outline"></ion-icon> {{count($curso->users)}} Participantes</p>
        
        @if(!$hasUserJoined)
          <form action="/events/join/{{$curso->id}}" method="POST">
          @csrf
          <a href="/events/join/{{$curso->id}}" class="btn btn-primary" id="event-submit" onclick="event.preventDefault(); this.closest('form').submit();">Participar do Curso</a>
          </form>
        @else
        <p class="already-joined-msg">Você ja esta cadastrado nesse curso</p>
        @endif
      </div>
      <div class="col-md-12" id="description-container">
        <h3>Sobre o evento:</h3>
        <p class="event-description">{{ $curso->descricao }}</p>
      </div>
    </div>
  </div>

@endsection