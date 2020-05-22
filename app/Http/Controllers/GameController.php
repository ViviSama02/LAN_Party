<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Game;
use App\Tournament;
use App\Lan;
use App\Team;

class GameController extends Controller
{
    public function __construct(){
      $this->middleware('auth')->only(['register', 'unregister']);
    }

    public function index(Tournament $tournament){
        $game=$tournament->game;
        return view('games.show',compact('tournament','game'));
    }

    public function create(){
        return view('games.create')
    }

    public function update(Request $request,Lan $lan, Tournament $tournament){
      $request->validate([
          'titre_jeu' => 'required|string'
      ]);
      $game->update($request->all());
      return redirect()->route('games.show');
    }

    public function destroy(Game $game){
      $game->delete();
      return redirect()->route('games.index');
    }
}
