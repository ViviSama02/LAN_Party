<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tournament extends Model
{
    protected $fillable = ['api', 'nom', 'type', 'tournament', 'url'];

    use Notifiable;

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function lan()
    {
        return $this->belongsTo(Lan::class);
    }

    public function isRegistered(?User $user): bool
    {
        return $this->team($user) !== null;
    }

    public function team(?User $user): ?Team
    {
        return $user ? $user->teams()
            ->where('tournament_id', $this->id)
            ->wherePivot('accepte', true)
            ->first() : null;
    }

    /**
     * @param User $user L'utilisateur à enregistrer au tournoi
     * Créer une équipe dont l'utilisateur est l'unique participant et avec comme nom d'équipe son nom.
     */
    public function register(User $user)
    {
        $team = $this->teams()->create([
            'nom' => $user->name
        ]);
        $team->join($user, true);
        $this->teams()->save($team);
    }

    public function unregister(User $user)
    {
        $teams = $user->teams()->where('tournament_id', $this->id)->get();
        foreach($teams as $team)
        {
            $team->leave($user);
        }
    }

    public function challonge(): Challonge
    {
        return new Challonge($this->api);
    }

    /**
     * Récupère l'URL associé à la langue, permet de traduire l'iframe en français
     * @param string $lang Le code de language (en, fr...)
     */
    public function localUrl(string $lang = 'fr'): string
    {
        return substr_replace($this->url, $lang . '/', strlen("https://challonge.com/"), 0);
    }
}
