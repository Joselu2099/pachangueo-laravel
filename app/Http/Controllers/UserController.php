<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function join($teamId) {
        $team = Team::findOrFail($teamId);
        $gameId = DB::table('players')
            ->where('team_id', $teamId)
            ->whereNull('user_id')
            ->value('game_id');

        DB::table('players')->insert([
            'team_id' => $teamId,
            'game_id' => $gameId,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('games.show', $gameId);
    }

    public function exit($teamId) {
        $gameId = DB::table('players')
            ->where('team_id', $teamId)
            ->where('user_id', Auth::id())
            ->value('game_id');

        DB::table('players')
            ->where('team_id', $teamId)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('games.show', $gameId);
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'token' => 'required',
            'preferredPosition' => 'required|in:DC,MC,DF,PT',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->token = $validatedData['token'];
        $user->preferredPosition = $validatedData['preferredPosition'];
        $user->image = $validatedData['image'];
        $user->save();

        if ($request->hasFile('image')) {
            $imageName = $user->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $user->setImage($imageName);
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'preferredPosition' => 'required|in:DC,MC,DF,PT',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->preferredPosition = $validatedData['preferredPosition'];
        $user->image = $validatedData['image'];
        $user->save();

        if ($request->hasFile('image')) {
            $imageName = $user->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $user->setImage($imageName);
        }

        return back(); // redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
