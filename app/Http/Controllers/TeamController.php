<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameMatch;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function show($id)
    {
        $team = GameMatch::findOrFail($id);
        $viewData = [];
        $viewData["title"] = "Ver Partido";
        $viewData["team"] = $team;
        //$viewData["teams"] = GameMatch::all()->where('game_id', '=', $id);
        return view('teams.show')->with("viewData", $viewData);
    }

    public function create($idGame)
    {
        $viewData = [];
        $viewData["title"] = "Crear Partido";
        $viewData["game_id"] = $idGame;
        return view('teams.crud.create')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        Team::validate($request);

        $team = new Team();
        $team->setName($request->input('name'));
        $team->setColor($request->input('color'));
        $team->setImage($request->input('image'));
        $gameId = $request->input('game_id');
        $team->save();

        if ($request->hasFile('image')) {
            $imageName = $team->getName()."_".$team->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $team->setImage($imageName);
            $team->save();
        }

        $team->save();
        $team->games()->attach($gameId);

        return redirect()->route('games.show', $gameId)->with('success', 'Pachanga creada correctamente!');
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $viewData = [];
        $viewData["title"] = "Mis Pachangas";
        $viewData["team"] = $team;

        return view('teams.crud.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        Team::validate($request);

        $team = Team::findOrFail($id);

        $team->setStartTime($request->input('startTime'));
        $team->setEndTime($request->input('endTime'));
        $team->setTeam1($request->input('team1_id'));
        $team->setTeam2($request->input('team2_id'));

        if ($request->hasFile('image')) {
            $imageName = $team->getName()."_".$team->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $team->setImage($imageName);
        }

        $team->save();

        return redirect()->back()->with('success', 'Pachanga creada correctamente!');
        //return redirect()->route('games.show', $team->getGameId())->with('success', 'Pachanga actualizada correctamente!');
    }

    public function delete($id)
    {
        $team = Team::find($id);
        $gameMatches = GameMatch::where('team1_id', $id)->orWhere('team2_id', $id)->get();
        foreach ($gameMatches as $gameMatch) {
            $gameMatch->delete();
        }
        $team->games()->detach();
        $team->delete();
        return redirect()->back()->with('success', 'Equipo eliminado correctamente!');
    }

}
