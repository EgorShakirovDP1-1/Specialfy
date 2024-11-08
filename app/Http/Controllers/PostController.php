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

use App\Models\Category;


class PostController extends Controller

{
    public function index()
{
    $categories = Category::all(); // Fetch all categories

    $posts = Post::with(['user', 'category'])->orderBy('created_at', 'ASC')->get()->map(function ($post) {
        // Check if the post is liked by the authenticated user
        $isLikedByUser = auth()->user() ? $post->likes()->where('user_id', auth()->id())->exists() : false;

        $like_count = $post->likes()->where('value', '1')->count();
        $dislike_count = $post->likes()->where('value', '0')->count();
        $rating = $like_count - $dislike_count;

        return [
            'id' => $post->id,
            'author' => $post->author,
            'category_id' => $post->category->id,
            'category_name' => $post->category->name,
            'price' => $post->price,
            'title' => $post->title,
            'text' => $post->description,
            'rating' => $rating,
            'likesCount' => $like_count,
            'isLikedByUser' => $isLikedByUser,
        ];
    });

    return Inertia::render('Posts/Posts', [
        'posts' => $posts,
        'categories' => $categories, // Pass categories to the component
    ]);
}
    // public function show($post_id)
    // {
        // $post = Post::find($post_id);


        public function show($post_id)
{
    // Find the post by its ID and load related pictures
    $post = Post::with('pictures')->find($post_id);

    // Generate URLs for images by removing "storage/app/"
    $postImages = $post->pictures->map(function ($picture) {
        $relativePath = str_replace('storage/app/public/', '', $picture->path_to_img);
        return asset('storage/' . $relativePath);
    });

    // Count likes and dislikes
    $post->likesCount = $post->likes()->where('value', '1')->count();
    $post->dislikesCount = $post->likes()->where('value', '0')->count();

    // Get profile photo of the authenticated user or default
    if (auth()->user()) {
        $authUser = auth()->user()->id;
        $user = User::find($authUser);
        $profilePhoto = $user->getImageURL();
    } else {
        $profilePhoto = asset(Storage::url('images/default-profile.png'));
    }

    // Get comments related to the post
    $comments = Comment::where('post_id', $post_id)
        ->orderBy('created_at', 'DESC')
        ->get();

    // Map comments to include user profile photos and other details
    $comments = $comments->map(function ($comment) {
        return [
            'comment' => $comment->comment,
            'profilePhoto' => optional($comment->user)->getImageURL() ?? 'default-profile.png', // Default profile image
            'name' => optional($comment->user)->name ?? 'Unknown User', // Default name
            'user_id' => optional($comment->user)->id,
            'id' => $comment->id,
            'post_id' => $comment->post_id,
            'editing' => true,
        ];
        
    });

    // Pass the post, images, and other necessary data to the view
    return Inertia::render('Posts/Post', [
        'post' => $post,
        'category_id' => $post->category,
        'profilePhoto' => $profilePhoto,
        'comments' => $comments,
        'postImages' => $postImages,  // Pass image URLs to the view
    ]);
}

        
    public function create()
    {
        
        $categories = Category::all();
        return Inertia::render('Posts/CreatePost',
    ['categories' => $categories]);
    }

    public function store(PostStoreRequest $request)
    {
        // Validate and save the main post data
        $validated = $request->validated();
        
        $post = Post::create([
            'user_id' => auth()->id(),
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'title' => $validated['title'],
            'text' => $validated['text'],
        ]);
    
        // Handle image uploads
        if ($request->hasFile('postImages')) {
            foreach ($request->file('postImages') as $image) {
                // Save each image and store its path in the 'postImages' directory within 'public' disk
                $filePath = $image->store('postImages', 'public');
    
                // Save image path in 'pictures' table associated with this post
                $post->pictures()->create([
                    'path_to_img' => $filePath,
                ]);
            }
        }
    
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