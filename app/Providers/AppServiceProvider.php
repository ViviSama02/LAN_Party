<?php

namespace App\Providers;

use App\Observers\TeamObserver;
use App\Observers\TournamentObserver;
use App\Team;
use App\Tournament;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Permet de mettre à jour le site challonge quand une modification de la base de données est effectuée
         */
        Tournament::observe(TournamentObserver::class);
        Team::observe(TeamObserver::class);
    }
}
