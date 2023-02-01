<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Mis Pachangas";
        $viewData['games'] = Game::whereHas('players', function ($query) {
            $query->where('user_id', Auth::id());
        })->orWhere('creator', Auth::id())->get();

        return view('games.index')->with("viewData", $viewData);
    }

    public function find()
    {
        $viewData = [];
        $viewData["title"] = "Pachangas";
        $viewData["games"] = Game::all();

        return view('games.find')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $game = Game::findOrFail($id);
        $viewData = [];
        $viewData["title"] = "Ver Pachanga";
        $viewData["matches"] = $game->matches;
        //$viewData["matches"] = GameMatch::all()->where('game_id', '=', $id);
        return view('games.show')->with("viewData", $viewData);
    }

    public function create()
    {
        $viewData = [];
        $viewData["title"] = "Crear Pachanga";
        return view('games.crud.create')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        Game::validate($request);

        $game = new Game();
        $game->setLocation($request->input('location'));
        $game->setDate($request->input('date'));
        $game->setSport($request->input('sport'));
        $game->setDescription($request->input('description'));
        $creator = $request->input('creator');
        $game->setCreator($creator);
        $game->save();
        $game->players()->attach(Auth::id());

        return redirect()->route('games.index')->with('success', 'Pachanga creada correctamente!');
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $viewData = [];
        $viewData["title"] = "Mis Pachangas";
        $viewData["game"] = $game;

        return view('games.crud.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        Game::validate($request);

        $game = Game::findOrFail($id);


        $game->setLocation($request->input('location'));
        $game->setDate($request->input('date'));
        $game->setSport($request->input('sport'));
        $game->setDescription($request->input('description'));
        $game->setCreator($request->input('creator'));
        $game->save();

        return redirect()->route('games.index');
    }

    public function delete($id)
    {
        $game = Game::find($id);
        $game->players()->detach();
        $game->delete();
        return redirect()->route('games.index');
    }

}
