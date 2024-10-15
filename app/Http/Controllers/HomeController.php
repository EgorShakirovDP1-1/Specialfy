<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index() {

        //new arriavals
        $posts = Post::orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

        foreach ($posts as $post) {
            $post->postImage1 = asset($post->postImage1);
            $post->likesCount = $post->likes->count();
        }

        if(auth()->user()){
            foreach ($posts as $post) {
                $post->isLikedByUser = $post->likes()->where('user_id', auth()->id())->exists();
            }
        }

        // start
        $unknownImage = asset(Storage::url('postImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png'));

        // 3.
        $twentycentuaryfoxImage = asset(Storage::url('postImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png'));

        // carousel
        $getStartedURLs = array(
            asset(Storage::url('postImages/cruelty-squad-the-movie-fanart-v0-3kdbpq8ywda81.png')),
            asset(Storage::url('postImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png')),
            asset(Storage::url('postImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png'))
        );

        // almost end
        $watchImage = asset(Storage::url('postImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png'));

        return Inertia::render('Home/Home', [
            'unknownImage' => $unknownImage,
            'twentycentuaryfoxImage' => $twentycentuaryfoxImage,
            'posts' => $posts,
            'getStartedURLs' => $getStartedURLs,
            'watchImage' => $watchImage,
        ]);
    }
}
