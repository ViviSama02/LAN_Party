<?php

namespace App\Observers;

use App\Challonge;
use App\Exceptions\ChallongeException;
use App\Tournament;
use Dotenv\Exception\ValidationException;

/**
 * Permet de générer un tournoi sur challonge.com quand un modèle de type Tournament est créé
 * avec une clé et des informations valides
 */
class TournamentObserver
{
    /**
     * Le tournoi créé n'a pas les attributs de challonge (ID du tournoi sur challonge, url)
     * L'observer doit définir ces méthodes sinon une erreur de type "pas de valeur par défaut" sera générée pour
     * ces attributs. Si l'appel API de la création du Tournoi échoue, on pourra lancer une exception.
     */
    public function creating(Tournament $tournament)
    {
        $challonge = $tournament->challonge();
        $json = $challonge->createTournament($tournament);
        $tournament->fill([
            'challonge_id' => $json->id,
            'nom' => $json->name,
            'url' => $json->full_challonge_url
        ]);
    }

    /**
     * Handle the tournament "updated" event.
     *
     * @param  \App\Tournament  $tournament
     * @return void
     */
    public function updated(Tournament $tournament)
    {
        //
    }

    /**
     * Handle the tournament "deleted" event.
     *
     * @param  \App\Tournament  $tournament
     * @return void
     */
    public function deleted(Tournament $tournament)
    {
        //
    }

    /**
     * Handle the tournament "restored" event.
     *
     * @param  \App\Tournament  $tournament
     * @return void
     */
    public function restored(Tournament $tournament)
    {
        //
    }

    /**
     * Handle the tournament "force deleted" event.
     *
     * @param  \App\Tournament  $tournament
     * @return void
     */
    public function forceDeleted(Tournament $tournament)
    {
        //
    }
}
