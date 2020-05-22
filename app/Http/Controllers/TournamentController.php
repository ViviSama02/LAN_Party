<?php

namespace App\Http\Controllers;

use App\Challonge;
use App\Exceptions\ChallongeException;
use App\Http\Requests\CreateTournamentRequest;
use App\Http\Requests\StoreTournamentRequest;
use App\Lan;
use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class TournamentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tournament::class, 'tournament');
    }

    public function create(CreateTournamentRequest $request)
    {
        return view('tournament.create', [
            'lan' => Lan::findOrFail($request->lan),
            'types' => Challonge::TYPES
        ]);
    }

    public function store(StoreTournamentRequest $request)
    {
        $lan = Lan::findOrFail($request->lan);

        try {
            $tournament = $lan->tournaments()->create($request->all());
        } catch(ChallongeException $exception) {
            throw ValidationException::withMessages(['key' => $exception->getErrors()]);
        }

        return redirect()->route('tournament.show', $tournament);
    }

    public function show(Tournament $tournament)
    {
        $lan = $tournament->lan;
        $user = Auth::user();
        $teams = $tournament->teams()->get();
        $userTeam = null;

        $userTeams = $user ?$user->teams()->withPivot('accepte')->where('teams.tournament_id', $tournament->id)->get() : [];
        $userTeamsStatus = [];

        foreach($userTeams as $team)
        {
            $userTeamsStatus[$team->id] = $team->pivot->accepte;
            if($team->pivot->accepte) {
                $userTeam = $team;
            }
        }

        return view('tournament.show', [
            'lan' => $lan,
            'tournament' => $tournament,
            'teams' => $teams,
            'userTeam' => $userTeam,
            'userTeamsStatus' => $userTeamsStatus,
            'types' => Challonge::TYPES
        ]);
    }

    public function edit(Tournament $tournament)
    {
        return view('tournament.edit', [
            'lan' => $tournament->lan,
            'tournament' => $tournament,
            'types' => Challonge::TYPES
        ]);
    }

    public function update(Request $request, Tournament $tournament)
    {
        $request->validate([
            'nom' => 'required|string|max:50'
        ]);

        $tournament->update($request->all());
        return redirect()->route("tournament.show", compact('lan', 'tournament'));
    }

    public function destroy(Tournament $tournament)
    {
        $tournament->delete();
        return redirect()->route('tournament.index');
    }
}
