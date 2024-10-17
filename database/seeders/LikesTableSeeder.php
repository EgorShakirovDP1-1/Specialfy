<?php

namespace Database\Seeders;

use App\Models\Post;
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
        $postIds = Post::all()->pluck('id');

        foreach ($userIds as $userId) {
            foreach ($postIds as $postId) {
                $randInt = random_int(0, 2);

                if ($randInt === 1) {
                    Like::insert([
                        'user_id' => $userId,
                        'post_id' => $postId,
                        'value' => random_int(min: 0, max: 1), 
                    ]);
                }
            }
        }
    }
}
