<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Picture;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PicturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pictures = [
            [
                'post_id' => 1,
                'path_to_img' => 'postImages/transport.jpg',
            ],
            [
                'post_id' => 2,
                'path_to_img' => 'postImages/beauty.jpg',

            ],
            [
                'post_id' => 3,
                'path_to_img' => 'postImages/maintenance.jpeg',
            ],
            [
                'post_id' => 4,
                'path_to_img' => 'postImages/transport.jpg',
            ],
            [
                'post_id' => 5,
                'path_to_img' => 'postImages/beauty.jpg',
            ],
            [
                'post_id' => 6,
                'path_to_img' => 'postImages/maintenance.jpeg',
            ],
        ];

        foreach ($pictures as $picture) {
            Picture::create($picture);
        }
    }
}