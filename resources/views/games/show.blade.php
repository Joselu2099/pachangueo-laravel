@extends('layouts.app')
@section('title', $viewData['title'])
@section('stylesheet')
    <link href="{{ asset('/css/index.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="subheader">
        <h1>Mis Partidos</h1>
    </div>
    <div class="container matches">
        <table class='table matches-table'>
            <thead>
            <tr>
                <th scope='col'>Hora de inicio</th>
                <th scope='col'>Hora de fin</th>
                <th scope='col'>Equipo 1</th>
                <th scope='col'>Equipo 2</th>
            </tr>
            </thead>
            <tbody>
                @foreach($viewData["matches"] as $match)
                    <tr>
                        <td>{{ $match->getStartTime() }}</td>
                        <td>{{ $match->getEndTime() }}</td>
                        <td>{{ $match->team1()->getName() }}</td>
                        <td>{{ $match->team2()->getName() }}</td>
                    </tr>
                @endforeach
            }
            ?>
            </tbody>
        </table>

    </div>
@endsection
