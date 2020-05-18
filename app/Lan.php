<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lan extends Model
{
    protected $fillable = [
        'nom',
        'info',
        'max',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function tournaments()
    {
        return $this->hasMany(Tournament::class);
    }

    public function noMorePlaces(): bool
    {
        return $this->users()->count() >= $this->max;
    }
}
