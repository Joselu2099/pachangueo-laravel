@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/crud.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="subheader">
        <h1>Crear Partido</h1>
    </div>
    <div class="container">
        <form action="{{ route('matches.crud.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="location">Hora de inicio</label>
                <input type="time" class="form-control" name="startTime" id="startTime" required>
            </div>
            <div class="form-group">
                <label for="location">Hora de finalización</label>
                <input type="time" class="form-control" name="endTime" id="endTime" required>
            </div>
            <div class="form-group">
                <label for="team1_id">Equipo 1</label>
                <select class="form-control" name="team1_id" id="team1_id" required>
                    <option value="" disabled selected>Selecciona el equipo 1</option>
                    @foreach($viewData["teams"] as $team)
                        <option value="{{ $team->getId() }}">{{ $team->getName() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="team2_id">Equipo 2</label>
                <select class="form-control" name="team2_id" id="team2_id" required>
                    <option value="" disabled selected>Selecciona el equipo 2</option>
                    @foreach($viewData["teams"] as $team)
                        <option value="{{ $team->getId() }}">{{ $team->getName() }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="game_id" id="game_id" value="{{ $viewData["game_id"] }}">
            <button type="submit" id="submit" class="btn btn-primary">Crear Partido</button>
            <a href="{{ back() }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('/js/teamsSelector.js') }}"></script>
@endsection
