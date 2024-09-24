<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index() {

        //new arriavals
        $films = Film::orderBy('created_at', 'DESC')
            ->take(6)
            ->get();

        foreach ($films as $film) {
            $film->filmImage1 = asset($film->filmImage1);
            $film->likesCount = $film->likes->count();
        }

        if(auth()->user()){
            foreach ($films as $film) {
                $film->isLikedByUser = $film->likes()->where('user_id', auth()->id())->exists();
            }
        }

        // start
        $unknownImage = asset(Storage::url('filmImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png'));

        // 3.
        $twentycentuaryfoxImage = asset(Storage::url('filmImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png'));

        // carousel
        $getStartedURLs = array(
            asset(Storage::url('filmImages/cruelty-squad-the-movie-fanart-v0-3kdbpq8ywda81.png')),
            asset(Storage::url('filmImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png')),
            asset(Storage::url('filmImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png'))
        );

        // almost end
        $watchImage = asset(Storage::url('filmImages/82hM0Dk62kt4U1TYcZfduRYviyHXAO9uKxeGQhCf.png'));

        return Inertia::render('Home/Home', [
            'unknownImage' => $unknownImage,
            'twentycentuaryfoxImage' => $twentycentuaryfoxImage,
            'films' => $films,
            'getStartedURLs' => $getStartedURLs,
            'watchImage' => $watchImage,
        ]);
    }
}
