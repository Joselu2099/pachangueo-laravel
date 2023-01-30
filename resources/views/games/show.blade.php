@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/games.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="subheader">
        <h1>Mis Partidos</h1>
        <a href="{{ route('matches.crud.create') }}" class="btn btn-primary">Crear Partido</a>
    </div>
    <div class="container matches">
        <table class='table matches-table'>
            <thead>
                <tr>
                    <th scope='col'>Hora de inicio</th>
                    <th scope='col'>Hora de fin</th>
                    <th scope='col'>Equipo 1</th>
                    <th scope='col'>Equipo 2</th>
                    <th scope='col'>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($viewData["matches"] as $match)
                    <tr>
                        <td>{{ $match->getStartTime() }}</td>
                        <td>{{ $match->getEndTime() }}</td>
                        <td><a href="{{ route('teams.show', $match->team1->getId()) }}" class="btn btn-primary" style="background-color: {{ $match->team1->getColor() }}">{{ $match->team1->getName() }}</a></td>
                        <td><a href="{{ route('teams.show', $match->team2->getId()) }}" class="btn btn-primary" style="background-color: {{ $match->team2->getColor() }}">{{ $match->team2->getName() }}</a></td>
                        <td>
                            <a href="{{ route('matches.crud.edit', $match->getId()) }}" class="btn btn-warning">Editar</a>
                            <a href="{{ route('matches.crud.delete', $match->getId()) }}" class="btn btn-warning">Borrar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
