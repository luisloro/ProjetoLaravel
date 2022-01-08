@extends('layouts.main')

@section('title', 'Criação de Curso')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Crie o novo Curso</h1>
  <form action="/events" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="nomeCurso">Imagem do Curso :</label>
      <input type="file" class="from-control-file" name="imagemCurso" id="imagemCurso">
    </div>
    <div class="form-group">
      <label for="nomeCurso">Curso:</label>
      <input type="text" class="form-control" id="nomeCurso" name="nomeCurso" placeholder="Nome do Curso">
    </div>
    <div class="form-group">
      <label for="nomeProfessor">Professor:</label>
      <input type="text" class="form-control" id="nomeProfessor" name="nomeProfessor" placeholder="Professor do curso">
    </div>
    <div class="form-group">
      <label for="descricao">Descrição:</label>
      <textarea name="descricao" id="descricao" class="form-control" placeholder="Descrição sobre o curso"></textarea>
    </div>
    <div class="form-group">
      <label for="horario">Horario do Curso:</label>
      <input type="text" class="form-control" id="horario" name="horario" placeholder="Horario do Curso">
    </div>
    <div class="form-group">
      <label for="date">Data do Curso:</label>
      <input type="date" class="form-control" id="data" name="data" >
    </div>
    <input type="submit" class="btn btn-primary" value="Criar Novo Curso">
  </form>
</div>

@endsection