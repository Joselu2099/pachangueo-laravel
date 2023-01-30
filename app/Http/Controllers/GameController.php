<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Mis Pachangas";
        $viewData["games"] = Game::all();

        return view('games.index')->with("viewData", $viewData);
    }

    public function create()
    {
        $viewData = [];
        $viewData["title"] = "Crear Pachanga";
        return view('games.crud.create')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'location' => 'required|max:255',
            'date' => 'required|date',
            'sport' => 'required|in:Futbol Sala,Futbol 7,Baloncesto',
            'description' => 'nullable',
            'creator' => 'required|exists:users,id',
        ]);

        $game = new Game();
        $game->location = $validatedData['location'];
        $game->sport = $validatedData['sport'];
        $game->description = $validatedData['description'];
        $game->creator_id = Auth::id();
        $game->save();

        return redirect()->route('games.index')->with('success', 'Game created successfully!');
    }

    public function show($id)
    {
        $game = Game::find($id);
        $viewData = [];
        $viewData["title"] = "Ver Pachanga";
        $viewData["matches"] = GameMatch::all()->where('game_id', '=', $id);
        return view('games.show')->with("viewData", $viewData);
    }

    public function edit($id)
    {
        $game = Game::find($id);
        $viewData = [];
        $viewData["title"] = "Mis Pachangas";
        $viewData["game"] = $game;

        return view('games.crud.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        $game = Game::find($id);

        $validatedData = $request->validate([
            'location' => 'required|max:255',
            'date' => 'required|date',
            'sport' => 'required|in:Futbol Sala,Futbol 7,Baloncesto',
            'description' => 'nullable',
            'creator' => 'required|exists:users,id',
        ]);

        $game->location = $validatedData['location'];
        $game->sport = $validatedData['sport'];
        $game->description = $validatedData['description'];
        $game->creator_id = $validatedData['creator'];

        $game->save();
        return redirect()->route('games.index');
    }

    public function delete($id)
    {
        Game::destroy($id);
        return redirect()->route('games.index');
    }
}
