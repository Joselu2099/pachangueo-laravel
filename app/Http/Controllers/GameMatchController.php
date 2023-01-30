<?php

namespace App\Http\Controllers;

use App\Models\GameMatch;
use Illuminate\Http\Request;

class GameMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gameMatches = GameMatch::all();
        return view('gameMatches.index', compact('gameMatches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gameMatches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'startTime' => 'required',
            'endTime' => 'required',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
        ]);

        $gameMatch = new GameMatch();
        $gameMatch->date = $validatedData['date'];
        $gameMatch->start_time = $validatedData['startTime'];
        $gameMatch->end_time = $validatedData['endTime'];
        $gameMatch->team1_id = $validatedData['team1_id'];
        $gameMatch->team2_id = $validatedData['team2_id'];
        $gameMatch->save();

        return redirect()->route('gameMatches.index')->with('success', 'GameMatch created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GameMatch  $gameMatch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gameMatch = GameMatch::find($id);
        return view('gameMatches.show', compact('gameMatch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GameMatch  $gameMatch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gameMatch = GameMatch::find($id);
        return view('gameMatches.edit', compact('gameMatch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GameMatch  $gameMatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gameMatch = GameMatch::find($id);

        $validatedData = $request->validate([
            'startTime' => 'required',
            'endTime' => 'required',
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|exists:teams,id',
        ]);

        $gameMatch->date = $validatedData['date'];
        $gameMatch->start_time = $validatedData['startTime'];
        $gameMatch->end_time = $validatedData['endTime'];
        $gameMatch->team1_id = $validatedData['team1_id'];
        $gameMatch->team2_id = $validatedData['team2_id'];
        $gameMatch->save();

        $gameMatch->save();
        return redirect()->route('gameMatches.index');
    }

    public function destroy($id)
    {
        $gameMatch = GameMatch::find($id);
        $gameMatch->delete();
        return redirect()->route('gameMatches.index');
    }
}
