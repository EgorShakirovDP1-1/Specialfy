<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO run seeders
        // php artisan migrate:fresh && php artisan db:seed --class=MainSeeder

        $this->call([
            TermsSeeder::class,
            UserTableSeeder::class,
            FilmsSeeder::class,
            LikesTableSeeder::class,
            CommentsSeeder::class,
            ReservationsSeeder::class,
        ]);
    }
}
