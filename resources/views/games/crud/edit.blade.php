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
        <form action="{{ route('games.crud.update', $viewData["game"]->getId()) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="location">Localización</label>
                <input type="text" class="form-control" name="location" id="location"
                       value="{{ $viewData['game']->getLocation() }}" required>
            </div>
            <div class="form-group">
                <label for="date">Fecha</label>
                <input type="date" class="form-control" name="date" id="date" value="{{ $viewData['game']->getDate() }}" required>
            </div>
            <div class="form-group">
                <label for="sport">Deporte</label>
                <select class="form-control" name="sport" id="sport" required>
                    @foreach(['Futbol Sala', 'Futbol 7', 'Baloncesto'] as $sport)
                        <option
                            value="{{ $sport }}" {{ $viewData['game']->getSport() == $sport ? 'selected' : '' }}>{{ $sport }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" name="description"
                          id="description">{{ $viewData['game']->getDescription() }}</textarea>
            </div>
            <input type="hidden" name="creator" id="creator" value="{{ Auth::id() }}">
            <button type="submit" class="btn btn-primary">Editar Pachanga</button>
            <a href="{{ route('games.index') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
@endsection
