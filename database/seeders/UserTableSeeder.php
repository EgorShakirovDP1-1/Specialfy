<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sergey Tykvov',
            'is_admin' => 1,
            'phone_number' => bcrypt('12345678'),
            'email' => bcrypt('egorsha2005@gmail.com'),
            'avatar' => null,
            'password' => bcrypt('12345678'),
            'user_type' => 1,
            'last_login' => Date("Y-m-d")
        ]);

        $users = rand(50, 200);

        User::factory($users)->create();
    }
}
