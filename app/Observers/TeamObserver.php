<?php

namespace App\Observers;

use App\Team;

class TeamObserver
{
    /**
     * Handle the team "created" event.
     *
     * @param  \App\Team  $team
     * @return void
     */
    public function creating(Team $team)
    {
        $challonge = $team->tournament->challonge();
        $json = $challonge->createParticipant($team);
        $team->fill([
            'challonge_id' => $json->id,
            'nom' => $json->name
        ]);
    }

    /**
     * Handle the team "updated" event.
     *
     * @param  \App\Team  $team
     * @return void
     */
    public function updated(Team $team)
    {
        //
    }

    /**
     * Handle the team "deleted" event.
     *
     * @param  \App\Team  $team
     * @return void
     */
    public function deleted(Team $team)
    {
        $challonge = $team->tournament->challonge();
        $challonge->deleteParticipant($team);
    }

    /**
     * Handle the team "restored" event.
     *
     * @param  \App\Team  $team
     * @return void
     */
    public function restored(Team $team)
    {
        //
    }

    /**
     * Handle the team "force deleted" event.
     *
     * @param  \App\Team  $team
     * @return void
     */
    public function forceDeleted(Team $team)
    {
        //
    }
}
