<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Term;
use App\Models\User;
use App\Models\Category;
use Inertia\Inertia;
use App\Models\Comment;


class AdminController extends Controller
{
    public function index()
    {
        $currentUser = auth()->id();
        $users = User::all()->count();
        $admins = User::where('is_admin', true)->count();
        $posts = Post::all()->count();
        //$postswithusers = Post::with('users')->get();
        $terms = Term::all()->count();
        $comments = Comment::all()->count();
        if (auth()->user()->is_admin) {
            return Inertia::render(
                'Admin/Panel',
                ['users' => $users, 'currentUser' => $currentUser, 'posts' => $posts, 'admins' => $admins, 'terms' => $terms, 'comments' => $comments ]
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
    $currentUser = auth()->id();

    // Fetch users excluding the currently authenticated user
    $users = User::where('id', '!=', $currentUser)->paginate(10);

    return Inertia::render('Admin/Users', [
        'users' => $users,
        'currentUser' => $currentUser,
    ]);
}
    
public function showStatistics()
{
    $postsCountByCategory = Post::select('category_id')
        ->with('category')
        ->get()
        ->groupBy('category_id')
        ->map(function ($posts, $categoryId) {
            return [
                'category' => Category::find($categoryId)->name ?? 'Unknown',
                'count' => $posts->count(),
            ];
        })
        ->values();

    return inertia('Admin/PostsCharts', [
        'postsCountByCategory' => $postsCountByCategory,
    ]);
}
    
}
