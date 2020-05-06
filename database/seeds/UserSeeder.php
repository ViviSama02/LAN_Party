<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $this->createFakeAdmin();
    }

    protected function createFakeAdmin(string $name = 'admin', string $password = 'admin'): void
    {
        User::create([
            'name' => $name,
            'email' => $name.'@'.$name.'.com',
            'password' => Hash::make($password),
        ]);
    }
}
