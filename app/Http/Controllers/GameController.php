<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Memes";
        $viewData["games"] = Game::all();
        return view('games.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $game = Game::findOrFail($id);
        $viewData["title"] = "Game";
        $viewData["game"] = $game;
        return view('games.show')->with("viewData", $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Game::validate($request);

        $input = $request->all();

        if ($image = $request->file('imgplantilla')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "plantilla." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['imgplantilla'] = "$profileImage";
        }

        //if(has)
        if ($image2 = $request->file('imgejemplo')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "ejemplo." . $image2->getClientOriginalExtension();
            $image2->move($destinationPath, $profileImage);
            $input['imgejemplo'] = "$profileImage";
        }

        Game::create($input);

        return redirect()->route('games.index')->with('success','Pachanga creada correctamente.');
    }
}
