<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Term;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Comment;


class AdminController extends Controller
{
    public function index()
    {
        $users = User::all()->count();
        $admins = User::where('is_admin', true)->count();
        $posts = Post::all()->count();
        //$postswithusers = Post::with('users')->get();
        $terms = Term::all()->count();
        $comments = Comment::all()->count();
        if (auth()->user()->is_admin) {
            return Inertia::render(
                'Admin/Panel',
                ['users' => $users, 'posts' => $posts, 'admins' => $admins, 'terms' => $terms, 'comments' => $comments ]
            );
        }

        return redirect()->route('home')->with('message', 'You are not an admin!');
    }

    public function postsTable()
    {
        $posts = Post::with('user', 'category')->paginate(10);

        return Inertia::render('Admin/Posts', ['posts' => $posts]);
    }

    public function usersTable()
    {
        $users = User::paginate(10);

        return Inertia::render('Admin/Users', ['users' => $users]);
    }
    
    public function PostsCharts()
    {
        // Fetch posts with their categories as a collection
        $posts = Post::with('category')->get();
    
        // Group posts by year or category name (depending on what 'name' refers to)
        $postsGroupedByYear = $posts->groupBy(function ($post) {
            return $post->created_at->format('Y');  // Group by the year the post was created
        });
    
        // Map the grouped posts to get the count for each year
        $postsCountByYear = $postsGroupedByYear->map(function ($postsInYear) {
            return $postsInYear->count();
        });
    
        // Return the data to Inertia
        return Inertia::render('Admin/PostsCharts', ['postsCountByYear' => $postsCountByYear]);
    }
    
}
