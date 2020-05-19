<?php

use App\Lan;
use App\Tournament;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tournaments')->delete();
        $faker = Faker\Factory::create('fr');
        Tournament::flushEventListeners();
        foreach(Lan::all() as $lan) {
            $lan->tournaments()->saveMany(factory(Tournament::class, 3)->make());
        }
    }
}
