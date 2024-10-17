<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'ASC')->get()->map(function ($post) {
            if (auth()->user()) {
                $isLikedByUser = $post->likes()->where('user_id', auth()->id())->exists();
            }

        $like_count = $post->likes()->where('value', '1')->count();
        $dislike_count = $post->likes()->where('value', '0')->count();
        $raiting = ($like_count - $dislike_count);

            return [
                'id' => $post->id,
                'author' => $post->author,
                'category' => $post->category,
                'Title' => $post->Title,
                'text' => $post->description,
                'rating' => $raiting,
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

        /* $PostImages = [];
        for ($i = 1; $i <= 8; $i++) {
            $imageKey = 'postImage' . $i;

            if ($request->hasFile($imageKey)) {
                $postImages[$imageKey] = $request->file($imageKey)->store('postImages', 'public');
            } else {
                $postImages[$imageKey] = null;
            }
        }
*/

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