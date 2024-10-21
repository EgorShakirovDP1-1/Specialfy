<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postIds = Post::all()->pluck('id');  // Get all post IDs

        $images = [
            [
                'path' => 'storage/app/public/n1.jpg',
                'post_id' => $postIds[random_int(0, count($postIds) - 1)],  // Adjust the index range here
            ],
        ];

        foreach ($images as $image) {
            Image::create($image);
        }
    }
}

