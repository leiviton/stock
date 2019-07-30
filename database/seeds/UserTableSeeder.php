<?php

use Stock\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create(
		[
            'name' => 'Leiviton Carlos',
            'email' => 'leivitoncs@gmail.com',
            'role' => 'admin',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);

        factory(User::class)->create(
            [
                'name' => 'Caio Lavos',
                'email' => 'caio@caio.com',
                'role' => 'admin',
                'password' => bcrypt(123456),
                'remember_token' => str_random(10),
            ]);
    }
}
