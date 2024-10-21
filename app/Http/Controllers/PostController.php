<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Picture;
use Inertia\Inertia;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index()
{
    // Eager-load the user relationship to include user data with posts
    $posts = Post::with('user')->orderBy('created_at', 'ASC')->get()->map(function ($post) {
        
        // Check if the post is liked by the authenticated user
        if (auth()->user()) {
            $isLikedByUser = $post->likes()->where('user_id', auth()->id())->exists();
        }

        // Calculate the like and dislike count and the rating
        $like_count = $post->likes()->where('value', '1')->count();
        $dislike_count = $post->likes()->where('value', '0')->count();
        $raiting = ($like_count - $dislike_count);

        // Access the author's name using the eager-loaded relationship
        $authorname = $post->user->name ?? 'Unknown'; // Fallback if user is null

        // Return the formatted post data
        return [
            'id' => $post->id,
            'user_id' => $post->user_id,
            'category' => $post->category,
            'Title' => $post->Title,
            'text' => $post->description,
            'rating' => $raiting,
            'author' => $post->name,
            'likesCount' => $like_count,
            'isLikedByUser' => $isLikedByUser ?? false,
        ];
    });


        return Inertia::render('Posts/Posts', [
            'posts' => $posts,
        ]);
    }

    public function show($post_id)
    {
        $post = Post::find($post_id);
        /*$post['postImage1'] = $post->getFirstImageURL();*/

        /*$postImages = $post->getImageURLs();*/

        $post->likesCount = $post->likes()->where('value', '1')->count();

        if (auth()->user()) {
            $authUser = auth()->user()->id;
            $user = User::find($authUser);
            $profilePhoto = $user->getImageURL();
        } else {
            $profilePhoto = asset(Storage::url('images/default-profile.png'));
        }

        $comments = Comment::where('post_id', $post_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $comments = $comments->map(function ($comment) {
            return [
                'comment' => $comment->comment,
                'profilePhoto' => $comment->user->getImageURL(),
                'name' => $comment->user->name,
                'user_id' => $comment->user->id,
                'id' => $comment->id,
                'post_id' => $comment->post_id,
                'editing' => true,
            ];
        });

        if (auth()->user()) {
            $post->isLikedByUser = $post->likes()->where('user_id', auth()->id())->exists();
        }

        return Inertia::render('Posts/Post', [
            'post' => $post,
           /* 'postImages' => $postImages, */
            'profilePhoto' => $profilePhoto,
            'comments' => $comments
        ]);
    }

    public function create()
    {
        return Inertia::render('Posts/CreatePost');
    }

    public function store(PostStoreRequest $request)
    {

        $validated = $request->validated();

        //  $PostImages = [];
        // for ($i = 1; $i <= 8; $i++) {
        //     $imageKey = 'postImage' . $i;

        //     if ($request->hasFile($imageKey)) {
        //         $postImages[$imageKey] = $request->file($imageKey)->store('postImages', 'public');
        //     } else {
        //         $postImages[$imageKey] = null;
        //     }
        // }

 foreach ($request->pictures as $picture) {
    $validated->pictures()->store([
         'url' => $picture['url'], // URL картинки
     ]);
 }
        $data = array_merge($validated/*,$postImages*/);

        Post::create($data);

        return redirect()->route('home')->with('message', 'Post created successfully!');
    }

    public function destroy($post_id)
    {
        if($post_id == null) {
            return redirect()->route('home')->with('message', 'Post not found!');
        }

        $post = Post::find($post_id);
        $post->delete();

        return redirect()->route('home')->with('message', 'post deleted successfully!');
    }
}