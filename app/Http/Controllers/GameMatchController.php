<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    public function create()
    {
        $viewData = [];
        $viewData["title"] = "Crear Partido";
        return view('matches.crud.create')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        GameMatch::validate($request);

        $gameMatch = new GameMatch();
        $gameMatch->setStartTime($request->input('startTime'));
        $gameMatch->setEndTime($request->input('endTime'));
        //Crear teams vacíos
        $team1 = new Team();
        $team1->save();
        $team2 = new Team();
        $team2->save();
        //Asignar sus ids
        $gameMatch->setTeam1Id($team1->getId());
        $gameMatch->setTeam2Id($team2->getId());
        $gameMatch->save();

        return back()->with('success', 'Partido creado correctamente!');
    }

    public function edit($id)
    {
        $gameMatch = GameMatch::findOrFail($id);
        $viewData = [];
        $viewData["title"] = "Mis Pachangas";
        $viewData["gameMatch"] = $gameMatch;

        return view('matches.crud.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        GameMatch::validate($request);

        $gameMatch = GameMatch::findOrFail($id);

        $gameMatch->setStartTime($request->input('startTime'));
        $gameMatch->setEndTime($request->input('endTime'));
        $gameMatch->setTeam1($request->input('team1_id'));
        $gameMatch->setTeam2($request->input('team2_id'));
        $gameMatch->save();

        return back();
    }

    public function delete($id)
    {
        GameMatch::destroy($id);
        return redirect()->route('matches.index');
    }
}
