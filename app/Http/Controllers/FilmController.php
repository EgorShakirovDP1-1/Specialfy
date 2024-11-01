<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\FilmStoreRequest;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::orderBy('created_at', 'ASC')->get()->map(function ($film) {
            if (auth()->user()) {
                $isLikedByUser = $film->likes()->where('user_id', auth()->id())->exists();
            }

        $like_count = $film->likes()->where('value', '1')->count();
        $dislike_count = $film->likes()->where('value', '0')->count();
        $raiting = ($like_count - $dislike_count);

            return [
                'id' => $film->id,
                'author' => $film->author,
                'model' => $film->model,
                'filmname' => $film->filmname,
                'genre' => $film->genre,
                'description' => $film->description,
                'volume' => $film->volume,
                'price_per_subscribtion' => $film->price_per_subscribtion,
                'price_per_watch' => $film->price_per_watch,
                'filmImageURL' => $film->getFirstImageURL(),
                'rating' => $raiting,
                'likesCount' => $like_count,
                'isLikedByUser' => $isLikedByUser ?? false,
            ];
        });

        return Inertia::render('Films/Films', [
            'films' => $films,
        ]);
    }

    public function show($film_id)
    {
        $film = Film::find($film_id);
        $film['filmImage1'] = $film->getFirstImageURL();

        $filmImages = $film->getImageURLs();

        $film->likesCount = $film->likes()->where('value', '1')->count();

        if (auth()->user()) {
            $authUser = auth()->user()->id;
            $user = User::find($authUser);
            $profilePhoto = $user->getImageURL();
        } else {
            $profilePhoto = asset(Storage::url('images/default-profile.png'));
        }

        $comments = Comment::where('film_id', $film_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $comments = $comments->map(function ($comment) {
            return [
                'comment' => $comment->comment,
                'profilePhoto' => $comment->user->getImageURL(),
                'name' => $comment->user->name,
                'user_id' => $comment->user->id,
                'id' => $comment->id,
                'film_id' => $comment->film_id,
                'editing' => true,
            ];
        });

        if (auth()->user()) {
            $film->isLikedByUser = $film->likes()->where('user_id', auth()->id())->exists();
        }

        return Inertia::render('Films/Film', [
            'film' => $film,
            'filmImages' => $filmImages,
            'profilePhoto' => $profilePhoto,
            'comments' => $comments
        ]);
    }

    public function create()
    {
        return Inertia::render('Films/CreateFilm');
    }

    public function store(FilmStoreRequest $request)
    {

        $validated = $request->validated();

        $FilmImages = [];
        for ($i = 1; $i <= 8; $i++) {
            $imageKey = 'filmImage' . $i;

            if ($request->hasFile($imageKey)) {
                $filmImages[$imageKey] = $request->file($imageKey)->store('filmImages', 'public');
            } else {
                $filmImages[$imageKey] = null;
            }
        }

        $data = array_merge($validated, $filmImages);

        Film::create($data);

        return redirect()->route('home')->with('message', 'Film created successfully!');
    }

    public function destroy($film_id)
    {
        if($film_id == null) {
            return redirect()->route('home')->with('message', 'Film not found!');
        }

        $film = Film::find($film_id);
        $film->delete();

        return redirect()->route('home')->with('message', 'film deleted successfully!');
    }
}
