@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/crud.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="subheader">
        <h1>Editar Equipo</h1>
    </div>
    <div class="container">
        <form action="{{ route('teams.crud.update', $viewData["team"]->getId()) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $viewData["team"]->getName() }}" required>
            </div>
            <div class="form-group">
                <label for="color">Color</label>
                <input type="color" class="form-control" name="color" id="color" value="{{ $viewData["team"]->getColor() }}" required>
            </div>
            <div class="form-group">
                <label for="image">Escudo</label>
                <input type="file" class="form-control" name="image" id="image" value="{{ $viewData["team"]->getImage() }}">
            </div>
            <button type="submit" class="btn btn-primary">Editar Equipo</button>
        </form>
    </div>
@endsection
