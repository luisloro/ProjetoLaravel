@extends('layouts.main')

@section('title', 'Editando' .$curso->nomeCurso)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Editando Curso {{$curso->nomeCurso}}</h1>
  <form action="/events/update/{{$curso->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="nomeCurso">Imagem do Curso :</label>
      <input type="file" class="from-control-file" name="imagemCurso" id="imagemCurso">
       <img src="/imagens/events/{{$curso->imagemCurso}}" alt="{{$curso->nomeCurso}}" class="img-preview">
    </div>
    <div class="form-group">
      <label for="nomeCurso">Curso:</label>
      <input type="text" class="form-control" id="nomeCurso" name="nomeCurso" placeholder="Nome do Curso" value="{{$curso->nomeCurso}}">
    </div>
    <div class="form-group">
      <label for="nomeProfessor">Professor:</label>
      <input type="text" class="form-control" id="nomeProfessor" name="nomeProfessor" placeholder="Professor do curso" value="{{$curso->nomeProfessor}}">
    </div>
    <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" id="descricao" class="form-control" placeholder="Descrição sobre o curso" value="{{$curso->descricao}}"></textarea>
    </div>
    <div class="form-group">
      <label for="horario">Horario do Curso:</label>
      <input type="text" class="form-control" id="horario" name="horario" placeholder="Horario do Curso" value="{{$curso->horario}}">
    </div>
    <div class="form-group">
      <label for="date">Data do Curso:</label>
      <input type="date" class="form-control" id="data" name="data" value="{{date('d/m/y', strtotime($curso->data))}}" >
    </div>
    <input type="submit" class="btn btn-primary" value="Editar Curso">
  </form>
</div>

@endsection