<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'nom', 'team'
    ];

    public function acceptedUsers()
    {
        return $this->users()->where('accepte', true);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('accepte');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    /**
     * @param User $user Le joueur à supprimer de l'équipe
     * Permet aussi d'annuler une demande à rejoindre une équipe,
     * et de refuser une demande à rejoindre une équipe
     * Si le joueur était le dernier de son équipe, supprime aussi l'équipe et le joueur est automatiquement désinscrit du tournoi.
     */
    public function leave(User $user)
    {
        $this->users()->detach($user);

        if(!$this->acceptedUsers()->exists()) {
            $this->delete();
        }
    }

    /**
     * @param User $user Le joueur qui postule à l'équipe
     * @param bool accepte Si le joueur est d'office accepté dans l'équipe (false pour une demande)
     */
    public function join(User $user, bool $accepte = false)
    {
        $this->users()->attach($user, ['accepte' => $accepte]);
    }
}
