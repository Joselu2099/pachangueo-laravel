@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/matches.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <section class="game-show">
        <div class="container games-matches">
            <div class="subheader">
                <h1>Partidos</h1>
                @if(count($viewData["teams"])>1 && \Illuminate\Support\Facades\Auth::id()==$viewData["game"]->getCreator())
                    <a href="{{ route('matches.crud.create', $viewData["game_id"]) }}" class="btn btn-primary">Crear Partido</a>
                @else
                    <a href="{{ route('matches.crud.create', $viewData["game_id"]) }}" class="btn btn-primary disabled">Crear Partido</a>
                @endif
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
                            <td><a href="{{ route('teams.show', $match->team1->getId()) }}" class="btn btn-primary"
                                   style="background-color: {{ $match->team1->getColor() }}; text-shadow: 1px 1px 3px #000;">{{ $match->team1->getName() }}</a>
                            </td>
                            <td><a href="{{ route('teams.show', $match->team2->getId()) }}" class="btn btn-primary"
                                   style="background-color: {{ $match->team2->getColor() }}; text-shadow: 1px 1px 3px #000;">{{ $match->team2->getName() }}</a>
                            </td>
                            <td class="actions">
                                <a href="{{ route('matches.crud.edit', $match->getId()) }}" class="btn btn-warning">
                                    <img class="app-icon" src="{{ asset('/images/edit.png') }}">
                                </a>
                                <a href="#" class="btn btn-danger"
                                   onclick="if(confirm('¿Esta seguro de que desea borrar este partido?')) { document.getElementById('delete-form-{{ $match->getId() }}').submit(); }">
                                    <img class="app-icon" src="{{ asset('/images/delete.png') }}">
                                </a>
                                <form id="delete-form-{{ $match->getId() }}"
                                      action="{{ route('matches.crud.delete', $match->getId()) }}" method="post"
                                      style="display: none;">
                                    @method('delete')
                                    @csrf
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container teams">
            <div class="subheader">
                <h1>Equipos</h1>
                @if(\Illuminate\Support\Facades\Auth::id()==$viewData["game"]->getCreator())
                    <a href="{{ route('teams.crud.create', $viewData["game_id"]) }}" class="btn btn-primary">Crear Equipo</a>
                @else
                    <a href="{{ route('teams.crud.create', $viewData["game_id"]) }}" class="btn btn-primary disabled">Crear Equipo</a>
                @endif
            </div>
            <div class="container matches">
                <table class='table matches-table'>
                    <thead>
                    <tr>
                        <th scope='col'>Nombre</th>
                        <th scope='col'>Color</th>
                        <th scope='col'>Escudo</th>
                        <th scope='col'>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($viewData["teams"] as $team)
                        <tr>
                            <td>{{ $team->getName() }}</td>
                            <td><input type="color"  value="{{ $team->getColor() }}" readonly disabled></td>
                            <td><img src="{{ asset('/storage/'. $team->getImage()) }}" style="height: 4rem" alt=""></td>
                            <td class="actions">
                                @if(!$team->users->contains(Auth::id()))
                                    <a href="{{ route('users.join', $team->getId()) }}" class="btn btn-success">
                                        <img class="app-icon" src="{{ asset('/images/join.png') }}">
                                    </a>
                                @else
                                    <a href="{{ route('users.exit', $team->getId()) }}" class="btn btn-danger">
                                        <img class="app-icon" src="{{ asset('/images/exit.png') }}">
                                    </a>
                                @endif
                                <a href="{{ route('teams.crud.edit', $team->getId()) }}" class="btn btn-warning">
                                    <img class="app-icon" src="{{ asset('/images/edit.png') }}">
                                </a>
                                <a href="#" class="btn btn-danger"
                                   onclick="if(confirm('¿Esta seguro de que desea borrar este equipo?')) { document.getElementById('delete-form-{{ $team->getId() }}').submit(); }">
                                    <img class="app-icon" src="{{ asset('/images/delete.png') }}">
                                </a>
                                <form id="delete-form-{{ $team->getId() }}"
                                      action="{{ route('teams.crud.delete', $team->getId()) }}" method="post"
                                      style="display: none;">
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="subheader back">
        <a href="{{ route('games.index') }}" class="btn btn-danger">Volver atrás</a>
    </div>
@endsection
