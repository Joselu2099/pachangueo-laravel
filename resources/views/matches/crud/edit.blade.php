@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/crud.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="subheader">
        <h1>Editar Partido</h1>
    </div>
    <div class="container">
        <form action="{{ route('matches.crud.update', $viewData["gameMatch"]->getId()) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="location">Hora de inicio</label>
                <input type="time" class="form-control" name="startTime" id="startTime"
                       value="{{ $viewData['gameMatch']->getStartTime() }}" required>
            </div>
            <div class="form-group">
                <label for="location">Hora de finalización</label>
                <input type="time" class="form-control" name="endTime" id="endTime"
                       value="{{ $viewData['gameMatch']->getEndTime() }}" required>
            </div>
            <div class="form-group">
                <label for="team1_id">Equipo 1</label>
                <select class="form-control" name="team1_id" id="team1_id" required>
                    @foreach($viewData["teams"] as $team)
                        <option value="{{ $team->getId() }}" {{ $viewData['gameMatch']->getTeam1Id() == $team->getId() ? 'selected' : '' }}>{{ $team->getName() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="team2_id">Equipo 2</label>
                <select class="form-control" name="team2_id" id="team2_id" required>
                    @foreach($viewData["teams"] as $team)
                        <option value="{{ $team->getId() }}" {{ $viewData['gameMatch']->getTeam2Id() == $team->getId() ? 'selected' : '' }}>{{ $team->getName() }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Editar Pachanga</button>
            <a href="{{ route('games.show') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
@endsection
