<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(Team $team)
    {
        // Vérifier que l'utilisateur appartient bien à l'équipe
        if(!$team->users->contains(Auth::user()))
        {
            return abort(403, "Vous n'appartenez pas à l'équipe");
        }

        $tournament = $team->tournament;
        $lan = $tournament->lan;
        return view('team.edit', compact('lan', 'tournament', 'team'));
    }

    public function update(Request $request, Team $team)
    {
        $team->update($request->all());
        $tournament = $team->tournament;
        $lan = $tournament->lan;
        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'));
    }

    public function accept(Team $team, User $user)
    {
        // Vérifier que l'utilisateur appartient bien à l'équipe
        if(!$team->users->contains(Auth::user()))
        {
            return abort(403, "Vous n'appartenez pas à l'équipe");
        }

        $team->users()->updateExistingPivot($user->id    , ['accepte' => true], true);

        $tournament = $team->tournament;
        $lan = $tournament->lan;
        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'));
    }

    public function refuse(Team $team, User $user)
    {
        // Vérifier que l'utilisateur appartient bien à l'équipe
        if(!$team->users->contains($user))
        {
            return abort(403, "Vous n'appartenez pas à l'équipe");
        }

        $team->leave($user);

        $tournament = $team->tournament;
        $lan = $tournament->lan;
        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'));
    }

    public function join(Team $team)
    {
        $user = Auth::user();
        $tournament = $team->tournament;
        $lan = $tournament->lan;

        // Vérifier que l'utilisateur n'appartient pas à l'équipe
        if($team->users->contains(Auth::user()))
        {
            return abort(403, "Vous appartenez déjà à l'équipe");
        }

        $team->join($user);

        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
            ->with('status', "Demande de rejoindre l'équipe envoyée avec succès.")
            ->with('status-type', 'info');
    }

    public function quit(Team $team)
    {
        $user = Auth::user();
        $tournament = $team->tournament;
        $lan = $tournament->lan;

        // Vérifier que l'utilisateur appartient bien à l'équipe
        if(!$team->users->contains($user))
        {
            return abort(403, "Vous n'appartenez pas à l'équipe");
        }

        $team->leave($user);

        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
            ->with('status', 'Équipe quittée avec succès.')
            ->with('status-type', 'info');
    }
}
