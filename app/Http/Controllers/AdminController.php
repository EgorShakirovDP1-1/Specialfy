<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Term;
use App\Models\User;
use App\Models\Category;
use Inertia\Inertia;
use App\Models\Comment;

use Illuminate\Http\Request;
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

    public function usersTable(Request $request)
    {
        $currentUser = auth()->id();
    
        // Initialize query excluding the current user
        $query = User::where('id', '!=', $currentUser);
    
        // Check if a search query is present
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
            });
        }
    
        // Paginate after filtering
        $users = $query->paginate(10)->withQueryString();
    
        return Inertia::render('Admin/Users', [
            'users' => $users,
            'currentUser' => $currentUser,
            'filters' => $request->only(['search']),
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
public function categories()
{
    {
        $categories = Category::all();
        return inertia('Admin/Categories', ['categories' => $categories]);
    }
}
public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('home')->with('success', 'Category deleted successfully!');
    }


    public function store(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:100'
        ]);

        // Create the category
        Category::create($validatedData);

        // Redirect back with a success message
        return redirect()->route('home')->with('success', 'Category created successfully!');
    }


    
}
