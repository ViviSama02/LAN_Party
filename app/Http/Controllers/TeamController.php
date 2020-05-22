<?php

namespace App\Http\Controllers;

use App\Team;
use App\Tournament;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class TeamController extends Controller
{
    public static function routes()
    {
        $class = 'TeamController';
        Route::resource('team', $class);

        $action = function($name) use($class) {
            Route::post('team/{team}/' . $name, $class . '@' . $name)->name('team.' . $name);
        };

        $action('join');
        $action('leave');
        $action('refuse');
        $action('accept');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        return view('team.create', [
            'tournament' => Tournament::findOrFail($request->tournament)
        ]);
    }

    public function store(Request $request)
    {
        $tournament = Tournament::findOrFail($request->tournament);

        // Créer la team
        $team = $tournament->teams()->create($request->all());

        // Inscrit l'utilisateur qui a créé la team automatiquement
        $team->join(Auth::user(), true);

        return redirect()->route('tournament.show', $tournament);
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
        return redirect()->route('tournament.show', $tournament);
    }

    /**
     * Accepter une demande à rejoindre une équipe
     */
    public function accept(Team $team, User $user)
    {
        // Vérifier que l'utilisateur appartient bien à l'équipe
        if(!$team->users->contains(Auth::user()))
        {
            return abort(403, "Vous n'appartenez pas à l'équipe");
        }

        $team->users()->updateExistingPivot($user->id, ['accepte' => true], true);

        $tournament = $team->tournament;
        $lan = $tournament->lan;
        return redirect()->route('tournament.show', $tournament);
    }

    /**
     * Refuser une demande à rejoindre une équipe
     */
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
        return redirect()->route('tournament.show', $tournament);
    }

    /**
     * Demander à rejoindre une équipe
     */
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

        return redirect()->route('tournament.show', $tournament)
            ->with('status', "Demande de rejoindre l'équipe envoyée avec succès.")
            ->with('status-type', 'info');
    }

    /**
     * Quitter une équipe
     * Ou annuler une demande de rejoindre une équipe
     */
    public function leave(Team $team)
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

        return redirect()->route('tournament.show', $tournament)
            ->with('status', 'Équipe quittée avec succès.')
            ->with('status-type', 'info');
    }
}
