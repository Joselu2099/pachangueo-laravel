@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div id="carouselInicio" class="carousel slide carousel-dark" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselInicio" data-slide-to="0" class="active"></li>
            <li data-target="#carouselInicio" data-slide-to="1"></li>
            <li data-target="#carouselInicio" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('/images/imgInicio1.png') }}" class="d-block w-100" alt="imgPachangueo">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Trabaja tu cuerpo</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/images/imgInicio2.png') }}" class="d-block w-100" alt="imgPachangueo">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Ejercita tu mente</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('/images/imgInicio3.png') }}" class="d-block w-100" alt="imgPachangueo">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Haz nuevas amistades</h5>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselInicio" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselInicio" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">

        <div class="subheader">
            <h1>Bienvenido a Pachangueo</h1>
            <p>Crea o unete a las mejores pachangas de la zona, crea nuevas amistades, ejercita tu cuerpo y tu
                mente!</p>
        </div>
    </div>
@endsection
