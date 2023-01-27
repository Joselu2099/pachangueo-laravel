<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
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
            'location' => 'required|max:255',
            'description' => 'nullable',
            'creator' => 'required|exists:users,id',
        ]);

        $game = new Game();
        $game->location = $validatedData['location'];
        $game->description = $validatedData['description'];
        $game->creator_id = $validatedData['creator'];
        $game->save();

        return redirect()->route('games.index')->with('success', 'Game created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::find($id);
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::find($id);
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $game = Game::find($id);

        $validatedData = $request->validate([
            'location' => 'required|max:255',
            'description' => 'nullable',
            'creator' => 'required|exists:users,id',
        ]);

        $game->location = $validatedData['location'];
        $game->description = $validatedData['description'];
        $game->creator_id = $validatedData['creator'];

        $game->save();
        return redirect()->route('games.index');
    }

    public function destroy($id)
    {
        $game = Game::find($id);
        $game->delete();
        return redirect()->route('games.index');
    }
}
