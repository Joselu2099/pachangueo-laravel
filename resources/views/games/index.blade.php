@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="subheader">
        <h1>Bienvenido a Memecultor</h1>
        <p>Crea tus mejores memes y compártelos con tus amigos!</p>
    </div>
    <div class="container">
        <div id="carouselMemes" class="carousel slide carousel-dark" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @foreach($viewData["memes"] as $meme)
                    <div class="carousel-item @if($loop->first) active @endif ">
                        <img src="{{ asset('/images/'.$meme->getImgEjemplo()) }}" class="d-block w-100" alt="{{ $meme->getNombre() }}">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $meme->getNombre() }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselMemes" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselMemes" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
@endsection
