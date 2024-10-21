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
use App\Models\Like;



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
    
    // public function show($post_id)
    // {
        // $post = Post::find($post_id);


    public function show($post_id)
    {
    
        // $post = Post::find($post_id);
        // $post['postImage1'] = $post->getFirstImageURL();

        $post = Post::find($post_id);
        // $postimg = Post::with('images')->findOrFail($post_id);

        $post->likesCount  = $post->likes()->where('value', '1')->count();
        $post->dislikesCount = $post->likes()->where('value', '0')->count();


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
                'editing'  => true,
            ];
        });

        if (auth()->user()) {
            $post->isLikedByUser = $post->likes()->where('user_id', auth()->id())->where('value', 1)->exists();
            $post->isDislikedByUser = $post->likes()->where('user_id', auth()->id())->where('value', 0)->exists();
        }

        return Inertia::render('Posts/Post', [
            'post' => $post,
            // 'postImages' => $postImages,
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



        Post::create($data);

        return redirect()->route('home')->with('message', 'Post created successfully!');
    }
    public function toggleLike(Request $request, $postId)
{
    $userId = auth()->id();
    $action = $request->action; // either 'like' or 'dislike'

    // Find the post and ensure it exists
    $post = Post::findOrFail($postId);

    // Check if the user has already liked or disliked this post
    $existingLike = $post->likes()->where('user_id', $userId)->first();

    if ($action === 'like') {
        if ($existingLike) {
            if ($existingLike->value === 1) {
                // User is unliking the post
                $existingLike->delete();
            } else {
                // User is switching from dislike to like
                $existingLike->update(['value' => 1]);
            }
        } else {
            // Add a new like
            $post->likes()->create([
                'user_id' => $userId,
                'value' => 1
            ]);
        }
    } elseif ($action === 'dislike') {
        if ($existingLike) {
            if ($existingLike->value === 0) {
                // User is undisliking the post
                $existingLike->delete();
            } else {
                // User is switching from like to dislike
                $existingLike->update(['value' => 0]);
            }
        } else {
            // Add a new dislike
            $post->likes()->create([
                'user_id' => $userId,
                'value' => 0
            ]);
        }
    }

    // After toggling like/dislike, redirect back to the same post
    return redirect()->route('post.show', ['post' => $postId]);
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