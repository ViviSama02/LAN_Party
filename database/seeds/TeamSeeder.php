<?php

use App\Team;
use App\Tournament;
use App\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->delete();
        DB::table('team_user')->delete();
        $faker = Faker\Factory::create('fr');
        Team::flushEventListeners();
        Tournament::all()->each(function(Tournament $tournament) use ($faker) {
            $lan = $tournament->lan;

            if($lan->users()->exists()) {

                // Créer des équipes avec des noms aléatoires (vides initiallement)
                $tournament->teams()->saveMany(factory(Team::class, $faker->numberBetween(0, 10))->make());

                if ($tournament->teams()->exists()) {
                    // Remplir les équipes avec des joueurs aléatoires
                    $lan->users
                        ->random($faker->numberBetween(0, $lan->users->count()))
                        ->each(function(User $user) use ($tournament) {
                            $tournament->teams->random()->join($user, true);
                        });
                }
            }
        });
    }
}
