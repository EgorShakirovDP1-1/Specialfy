<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::all()->pluck('id');
        $filmIds = Film::all()->pluck('id');

        foreach ($userIds as $userId) {
            foreach ($filmIds as $filmId) {
                $randInt = random_int(0, 2);

                if ($randInt === 1) {
                    Like::insert([
                        'user_id' => $userId,
                        'film_id' => $filmId,
                        'value' => random_int(min: 0, max: 1), 
                    ]);
                }
            }
        }
    }
}
