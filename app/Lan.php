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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
