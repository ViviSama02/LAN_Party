<?php

namespace App\Http\Controllers;

use App\Lan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RegistrationController extends Controller
{
    /**
     * Enregistres toutes les routes pour l'inscription
     */
    public static function routes()
    {
        $class = 'RegistrationController';
        Route::delete('lan/{lan}/registration', $class . '@destroy')->name('lan.registration.destroy');
        Route::resource('lan.registration', $class)->only('index', 'store');
    }

    /**
     * Affiche tous les utilisateurs inscrits à une LAN donnée
     */
    public function index(Lan $lan)
    {
        $users = $lan->users;
        return view('registration.index', [
            'users' => $users,
            'lan' => $lan
        ]);
    }

    /**
     * L'utilisateur souhaite s'insrire à une LAN
     */
    public function store(Lan $lan)
    {
        if($lan->users->contains(Auth::user())) {
            return redirect()->back()
                ->with('status', 'Vous ne pouvez pas vous inscrire à une LAN où vous êtes déjà inscrit!')
                ->with('status-type', 'danger');
        }

        if($lan->noMorePlaces()) {
            return redirect()->back()
                ->with('status', "Il n'y a plus de places à cette LAN.")
                ->with('status-type', 'danger');
        }

        $lan->users()->save(Auth::user());


        return redirect()->back()
            ->with('status', 'Inscrit avec succès à la LAN')
            ->with('status-type', 'success');
    }

    /**
     * L'utilisateur souhaite se désinscrire d'une LAN
     */
    public function destroy(Lan $lan)
    {
        if(!$lan->users->contains(Auth::user())) {
            return redirect()->back()
                ->with('status', "Vous ne pouvez pas vous désinscrire d'une LAN où vous n'êtes pas inscrit!")
                ->with('status-type', 'danger');
        }

        $lan->users()->detach(Auth::user());

        return redirect()->back()
            ->with('status', 'Désinscrit avec succès à la LAN')
            ->with('status-type', 'warning');
    }
}
