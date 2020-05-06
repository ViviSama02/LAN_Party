<?php

use App\Lan;
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
        Lan::create([
            'nom' => 'Super Lan venez tous !!!',
            'info' => "Y aura surement plein de super informations ici qui permettrons de voir en un coup d'oeil si c'est ce qu'on cherche.",
            'max' => 32,
            'date' => date('2020-11-25 20:00')
        ]);

        $faker = Faker\Factory::create('fr');
        for($i = 0; $i < 10; $i++) {
            Lan::create([
                'nom' => $faker->catchPhrase,
                'info' => $faker->text,
                'max' => $faker->numberBetween(1, 256),
                'date' => $this->roundToQuarterHour($faker->dateTime)
            ]);
        }
    }

    protected function roundToQuarterHour(DateTime $dateTime) {
        return $dateTime->setTime(
            $dateTime->format('H'),
            round((int)$dateTime->format('i') / 15) * 15,
            0
        );
    }
}
