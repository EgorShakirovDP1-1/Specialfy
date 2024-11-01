<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\CommentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//home
Route::get('/', [HomeController::class, 'index'])->name('home');

//auth
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
});

//logout
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// user
Route::middleware('auth')->prefix('profile/{user}')->group(function () {
    Route::get('/', [UserController::class, 'profile'])->name('profile');
    Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/edit', [UserController::class, 'update'])->name('update');
    Route::delete('/', [UserController::class, 'destroy'])->name('delete');
 

Route::patch('/make-admin', [UserController::class, 'makeAdmin'])
    ->name('users.make-admin');

});

//terms
Route::get('/terms', [TermController::class, 'index'])->name('terms');
Route::get('/privacypolicy', [TermController::class, 'privacy'])->name('privacy');

Route::middleware(['auth', 'admin'])->prefix('terms')->group(function () {
    Route::post('/create', [TermController::class, 'store'])->name('terms.create');
    Route::put('/{term}/edit', [TermController::class, 'update'])->name('terms.edit');
    Route::delete('/{term}', [TermController::class, 'destroy'])->name('terms.delete');
    
});

//privacy policy
// Route::get('/privacypolicy', [TermController::class, 'privacy'])->name('privacypolicy');

//learn
Route::get('/learn', [LearnController::class, 'index'])->name('learn');

//posts
Route::prefix('Posts')->group(function () {
    // Route::post('/{postId}/toggle-like', [PostController::class, 'toggleLike']);
    Route::get('/', [PostController::class, 'index'])->name('posts');

    Route::get('/create', [PostController::class, 'create'])->middleware(['auth'])->name('posts.create');
    Route::post('/create', [PostController::class, 'store'])->name('posts.create');


    Route::get('/{post}', [PostController::class, 'show'])->name('post.show');
    Route::post('/{postId}/toggleLike', [PostController::class, 'toggleLike'])->name('posts.toggleLike');


   

   
});

// Likes
Route::middleware('auth')->prefix('Posts/{post}')->group(function () {
    Route::post('/comment', [CommentController::class, 'store'])->name('comment');
    Route::put('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.delete');
});

// admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin');
    Route::get('/posts/table', [AdminController::class, 'postsTable'])->name('admin.posts');
   //Route::get('/posts/table', [AdminController::class, 'index'])->name('admin.users');
    Route::get('/posts/charts', [AdminController::class, 'postsCharts'])->name('admin.posts.charts');
    Route::get('/users', [AdminController::class, 'usersTable'])->name('admin.users.tables');
    
});

// GET	/photos	index	photos.index
// GET	/photos/create	create	photos.create
// POST	/photos	store	photos.store
// GET	/photos/{photo}	show	photos.show
// GET	/photos/{photo}/edit	edit	photos.edit
// PUT/PATCH	/photos/{photo}	update	photos.update
// DELETE	/photos/{photo}	destroy	photos.destroy