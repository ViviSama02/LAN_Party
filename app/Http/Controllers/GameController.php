<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class GameController extends Controller
{
    public function __construct(){
      $this->middleware('auth')->only(['register', 'unregister']);
    }

    public function index(Lan $lan){

    }

    public function create(){
        return view('games.create')
    }

    public function update(){

    }

    public function destroy(){

    }
}
