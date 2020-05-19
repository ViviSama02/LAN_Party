<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lan extends Model
{
    /**
     * Répertoire ou stocker les vignettes (thumbnails) des LANs
     */
    const IMAGES_DIRECTORY = 'images/lans';
    const IMAGE_PAR_DEFAUT = 'https://via.placeholder.com/2048';

    protected $fillable = [
        'nom',
        'info',
        'max',
        'date'
    ];

    /**
     * Récupère l'url de image de la LAN
     * Un URL vers un asset ou une image par défaut si celle-ci n'existe pas
     */
    public function thumbnail()
    {
        $path = 'storage/' . self::IMAGES_DIRECTORY . '/' . $this->id;

        if(file_exists(public_path($path))) {
            $thumbnail = asset($path);
        } else {
            $thumbnail = self::IMAGE_PAR_DEFAUT;
        }

        return $thumbnail;
    }

    /**
     * Sauvegarde l'image de la LAN
     * Ecrase l'ancienne si elle existait déjà
     */
    public function saveThumbnail($image)
    {
        $path = 'storage/' . self::IMAGES_DIRECTORY . '/' . $this->id;

        if(Storage::exists($path)) {
            Storage::delete($path);
        }

        $image->storeAs(self::IMAGES_DIRECTORY, $this->id, 'public');
    }

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
