<?php setlocale(LC_ALL, 'es_ES.UTF-8'); ?>
@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/games.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="subheader">
        <h1>Buscar Pachangas</h1>
    </div>
        @guest
            <h4 class="text-center">Tienes que estar registrado o entrar con tu usuario para acceder a esa sección.</h4>
    @else
        <div class="container games">
            <div class="row" id="row">
                @include('games.pagination')
            </div>
        </div>
    @endguest
    <script src="{{asset('/js/pagination.js')}}"></script>
@endsection
