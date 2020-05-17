<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lans()
    {
        return $this->belongsToMany(Lan::class);
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class)->withPivot('accepte');
    }

    /**
     * Récupère l'équipe associée à un tournoi, ou null si l'équipe n'existe pas
     */
    public function team(Tournament $tournament): ?Team
    {
        return $this->teams()->where('tournament_id', $tournament->id)->first();
    }
}
