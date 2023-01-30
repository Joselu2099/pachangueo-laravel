<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use Illuminate\Http\Request;

class GameMatchController extends Controller
{
    public function create()
    {
        return view('matches.crud.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'startTime' => 'required',
            'endTime' => 'required',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
        ]);

        $gameMatch = new GameMatch();
        $gameMatch->start_time = $validatedData['startTime'];
        $gameMatch->end_time = $validatedData['endTime'];
        $gameMatch->team1_id = $validatedData['team1_id'];
        $gameMatch->team2_id = $validatedData['team2_id'];
        $gameMatch->save();

        return back(); // redirect()->route('matches.index')->with('success', 'GameMatch created successfully!');
    }
    public function show($id)
    {
        $gameMatch = GameMatch::find($id);
        return view('matches.show', compact('gameMatch'));
    }
    public function edit($id)
    {
        $gameMatch = GameMatch::find($id);
        return view('matches.crud.edit', compact('gameMatch'));
    }
    public function update(Request $request, $id)
    {
        $gameMatch = GameMatch::find($id);

        $validatedData = $request->validate([
            'startTime' => 'required',
            'endTime' => 'required',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
        ]);

        $gameMatch->start_time = $validatedData['startTime'];
        $gameMatch->end_time = $validatedData['endTime'];
        $gameMatch->team1_id = $validatedData['team1_id'];
        $gameMatch->team2_id = $validatedData['team2_id'];
        $gameMatch->save();

        return back(); //redirect()->route('games.show');
    }

    public function delete($id)
    {
        $gameMatch = GameMatch::find($id);
        $gameMatch->delete();
        return back(); // redirect()->route('gameMatches.index');
    }
}
