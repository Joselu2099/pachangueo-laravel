<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameMatch;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GameMatchController extends Controller
{
    public function show($id)
    {
        $gameMatch = GameMatch::findOrFail($id);
        $viewData = [];
        $viewData["title"] = "Ver Partido";
        $viewData["gameMatch"] = $gameMatch;
        //$viewData["teams"] = GameMatch::all()->where('game_id', '=', $id);
        return view('matches.show')->with("viewData", $viewData);
    }

    public function create($idGame)
    {
        $game = Game::findOrFail($idGame);
        $viewData = [];
        $viewData["title"] = "Crear Partido";
        $viewData["game_id"] = $game->getId();
        $viewData["teams"] = $game->teams->unique();

        return view('matches.crud.create')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        GameMatch::validate($request);

        $gameMatch = new GameMatch();
        $gameMatch->setStartTime($request->input('startTime'));
        $gameMatch->setEndTime($request->input('endTime'));
        $gameMatch->setGameId($request->input('game_id'));
        $gameMatch->setTeam1Id($request->input('team1_id'));
        $gameMatch->setTeam2Id($request->input('team2_id'));
        /*Crear teams vacíos
        $team1 = new Team();
        $team1->save();
        $team2 = new Team();
        $team2->save();
        //Asignar sus ids
        $gameMatch->setTeam1Id($team1->getId());
        $gameMatch->setTeam2Id($team2->getId());
        */
        $gameMatch->save();

        return redirect()->route('games.show', $gameMatch->getGameId())->with('success', 'Pachanga creada correctamente!');
    }

    public function edit($id)
    {
        $gameMatch = GameMatch::findOrFail($id);
        $game = Game::findOrFail($gameMatch->getGameId());
        $viewData = [];
        $viewData["title"] = "Mis Pachangas";
        $viewData["gameMatch"] = $gameMatch;
        $viewData["teams"] = $game->teams->unique();

        return view('matches.crud.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'startTime' => 'required',
            'endTime' => 'required',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
        ]);

        $gameMatch = GameMatch::findOrFail($id);

        $gameMatch->setStartTime($request->input('startTime'));
        $gameMatch->setEndTime($request->input('endTime'));
        $gameMatch->setTeam1Id($request->input('team1_id'));
        $gameMatch->setTeam2Id($request->input('team2_id'));
        $gameMatch->save();

        return redirect()->route('games.show', $gameMatch->getGameId())->with('success', 'Pachanga actualizada correctamente!');
    }

    public function delete($id)
    {
        $gameId = GameMatch::findOrFail($id)->getGameId();
        GameMatch::destroy($id);
        return redirect()->route('games.show', $gameId)->with('success', 'Pachanga eliminada correctamente!');
    }
}
