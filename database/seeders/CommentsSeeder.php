<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\User;
use App\Models\Comment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all()->count();
        $films = Film::all()->count();
        $comments = $faker->numberBetween(50, 200);

        for ($i = 0; $i < $comments; $i++) {
            $comment = new Comment();
            $comment->user_id = $faker->numberBetween(1, $users);
            $comment->film_id = $faker->numberBetween(1, $films);
            $comment->comment = $faker->sentence();
            $comment->save();
        }
    }
}
