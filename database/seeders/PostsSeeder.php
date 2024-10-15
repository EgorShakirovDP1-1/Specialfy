<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::all()->pluck('id');


        $posts = [
            [
                'author' => $userIds[random_int(0,count($userIds))],
                'category' => 1,
                'price' => 12.50,
                'title' => '50.000 tons of concrete',
                'text' => 'I will transport 50.000 tons of concrete anywhere u need it, price is 12.50 dollars per gramm for every kilometer. Call me!',
            ],
            [
                'author' => $userIds[random_int(0,count($userIds))],
                'category' => 2,
                'price' => 200.99,
                'title' => 'Lip implants. Cheap price!',
                'text' => 'Lip implants XXL to XXXXXXL sizes. Proven quality. prices start at 200.99',

            ],
            [
                'author' => $userIds[random_int(0,count($userIds))],
                'category' => 3,
                'price' => 500.00,
                'title' => 'Implanting massage system into any car seat',
                'text' => 'I will insert massage system into any car seat, yes even into your grandparents old Moskvitch!',
            ],
            [
                'author' => $userIds[random_int(0,count($userIds))],
                'category' => 1,
                'price' => 50.50,
                'Title' => 'Prop transport',
                'text' => 'I will transport props for any video to the location of your choice within Baltia. Price is 50.50 per hour of transportation',
            ],
            [
                'author' => $userIds[random_int(0,count($userIds))],
                'category' => 2,
                'price' => 15.25,
                'TItle' => 'Nails for cool girls',
                'text' => 'If you are a cool girl that needs her nails done contact me, only 15.25 euros for a coll nail makeup!',
            ],
            [
                'author' => $userIds[random_int(0,count($userIds))],
                'category' => 3,
                'price' => 10.00,
                'Title' => 'Winter tires cheap',
                'text' => 'A set of winter tires for only 10 euros, installation included. Buy new fresh winter tires now!',
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
