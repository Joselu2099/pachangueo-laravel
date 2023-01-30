@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="subheader">
        <h1>Mis Pachangas</h1>
        <a href="{{ route('games.crud.create') }}" class="btn btn-primary">Crear Pachanga</a>
    </div>
    <div class="container games">
        <div class="row">
            @foreach($viewData["games"] as $game)
                <div class="card game-card" style="width: 18rem;">
                    <h5 class="card-header">{{ $game->getLocation() }}</h5>
                    <div class="card-body">
                        <h6 class="card-subtitle">Deporte: <span class="card-sport">{{ $game->getSport() }}</span></h6>
                        <p class="card-text">{{ substr($game->getDescription(), 0, 100) }}</p>
                        <div class="card-group-buttons">
                            <a href="{{ route('games.crud.edit', $game->getId()) }}" class="btn btn-warning">Editar</a>
                            <a href="{{ route('games.show', $game->getId()) }}" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
