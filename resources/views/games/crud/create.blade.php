@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/crud.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="subheader">
        <h1>Crear Pachanga</h1>
    </div>
    <div class="container">
        <form action="{{ route('games.crud.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="location">Localización</label>
                <input type="text" class="form-control" name="location" id="location" required>
            </div>
            <div class="form-group">
                <label for="sport">Deporte</label>
                <select class="form-control" name="sport" id="sport" required>
                    <option value="Futbol Sala">Futbol Sala</option>
                    <option value="Futbol 7">Futbol 7</option>
                    <option value="Baloncesto">Baloncesto</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" name="description" id="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Crear Pachanga</button>
            <a href="{{ route('games.index') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
@endsection
