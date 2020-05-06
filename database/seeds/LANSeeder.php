<?php

use App\LAN;
use Illuminate\Database\Seeder;

class LANSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lan')->delete();
        LAN::create([
            'nom' => 'Super LAN venez tous !!!',
            'info' => "Y aura surement plein de super informations ici qui permettrons de voir en un coup d'oeil si c'est ce qu'on cherche."
        ]);

        $faker = Faker\Factory::create('fr');
        for($i = 0; $i < 10; $i++) {
            LAN::create([
                'nom' => $faker->catchPhrase,
                'info' => $faker->text,
            ]);
        }
    }
}
