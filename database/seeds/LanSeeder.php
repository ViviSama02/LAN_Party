<?php

use App\Lan;
use App\User;
use Illuminate\Database\Seeder;

class LanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lans')->delete();
        DB::table('lan_user')->delete();
        $this->createFakeLan();
        $faker = Faker\Factory::create('fr');
        factory(Lan::class, 10)
            ->create()
            ->each(function(Lan $lan) use($faker) {
                $lan->users()->saveMany(User::all()->random($faker->numberBetween(0, $lan->max)));
            });
    }

    public function createFakeLan()
    {
        Lan::create([
            'nom' => 'Super Lan venez tous !!!',
            'info' => "Y aura surement plein de super informations ici qui permettrons de voir en un coup d'oeil si c'est ce qu'on cherche.",
            'max' => 32,
            'date' => date('2020-11-25 20:00')
        ]);
    }
}
