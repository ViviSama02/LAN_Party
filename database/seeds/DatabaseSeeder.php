<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        /*Cette version est obsolete: $this->call([UserSeeder::class, LanSeeder::class, TournamentSeeder::class, TeamSeeder::class]);*/
        $this->call('UserSeeder');
        $this->call('LanSeeder');
        $this->call('TournamentSeeder');
        $this->call('TeamSeeder');
    }
}
