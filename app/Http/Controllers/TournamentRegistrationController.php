<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TournamentRegistrationController extends Controller
{
    public function register(Lan $lan, Tournament $tournament)
    {
        $user = Auth::user();

        if($tournament->isRegistered(Auth::user())) {
            return redirect()->back()
                ->with('status', 'Vous ne pouvez pas vous inscrire à un tournoi où vous êtes déjà inscrit!')
                ->with('status-type', 'danger');
        }

        try {
            $tournament->register($user);
        } catch(ChallongeException $exception) {
            return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
                ->with('status', join('; ', config('app.debug') ? $exception->getErrors() : "Erreur challonge.com: " . $exception->getCode()))
                ->with('status-type', 'danger');
        }

        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
            ->with('status', 'Inscrit avec succès au Tournoi')
            ->with('status-type', 'success');
    }

    public function unregister(Lan $lan, Tournament $tournament)
    {
        $user = Auth::user();
        $team = $user->team($tournament);

        if($team == null) {
            return redirect()->back()
                ->with('status', "Vous ne pouvez pas vous désinscrire d'un Tournoi où vous n'êtes pas inscrit!")
                ->with('status-type', 'danger');
        }

        try {
            $tournament->unregister($user);
        } catch(ChallongeException $exception) {
            return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
                ->with('status', join('; ', config('app.debug') ? $exception->getErrors() : "Erreur challonge.com: " . $exception->getCode()))
                ->with('status-type', 'danger');
        }

        return redirect()->route('lan.tournament.show', compact('lan', 'tournament'))
            ->with('status', 'Désinscrit avec succès au Tournoi')
            ->with('status-type', 'info');
    }
}
