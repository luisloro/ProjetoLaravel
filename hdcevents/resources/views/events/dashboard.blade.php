@extends('layouts.main')

@section('title', 'Dasboard')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Cursos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($cursos) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cursos as $curso)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{ $curso->id }}">{{ $curso->nomeCurso }}</a></td>
                    <td>{{count($curso->users)}}</td>
                    <td>
                        <a href="/events/edit/{{$curso->id}}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a> 
                        <form action="/events/{{ $curso->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                        </form>
                    </td>
                </tr>
        @endforeach    
        </tbody>
    </table>
    @else
    <p>Você ainda não tem nenhum Curso <a href="/events/create">Criar Curso</a></p>
    @endif
</div>
<div  class="col-md-10 offset-md-1 dashboard-events-container">
    <h1>Cursos Inscritos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($cursosAsParticipant) > 0)
        <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cursosAsParticipant as $curso)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/events/{{ $curso->id }}">{{ $curso->nomeCurso }}</a></td>
                    <td>{{count($curso->users)}}</td>
                    <td>
                    <form action="/events/leave/{{ $curso->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> <ion-icon name="trash-outline"></ion-icon>Sair do Curso</button>
                        </form>
                    </td>
                </tr>
        @endforeach    
        </tbody>
    </table>
    @else
    <p>Você ainda não esta participando de nenhum Curso</p>
    @endif
</div>
@endsection