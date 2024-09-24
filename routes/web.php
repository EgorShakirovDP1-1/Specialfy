<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReservationController;

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
});

//terms
Route::get('/terms', [TermController::class, 'index'])->name('terms');

Route::middleware(['auth', 'admin'])->prefix('terms')->group(function () {
    Route::post('/create', [TermController::class, 'store'])->name('terms.create');
    Route::put('/{term}/edit', [TermController::class, 'update'])->name('terms.edit');
    Route::delete('/{term}', [TermController::class, 'destroy'])->name('terms.delete');
});

//learn
Route::get('/learn', [LearnController::class, 'index'])->name('learn');

//films
Route::prefix('films')->group(function () {
    Route::get('/', [FilmController::class, 'index'])->name('films');

    Route::get('/create', [FilmController::class, 'create'])->middleware(['auth', 'admin'])->name('films.create');
    Route::post('/create', [FilmController::class, 'store'])->middleware(['auth', 'admin'])->name('films.store');

    Route::get('/{film}', [FilmController::class, 'show'])->name('film.show');
    Route::post('/{film}', [ReservationController::class, 'store'])->name('reservation');

    Route::delete('/{film}/destroy', [FilmController::class, 'destroy'])->middleware(['auth', 'admin'])->name('film.destroy');
});

// Likes
Route::middleware('auth')->prefix('films/{film}')->group(function () {
    Route::post('/like', [LikeController::class, 'toggle'])->name('like');
    Route::post('/unlike', [LikeController::class, 'destroy'])->name('unlike');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment');
    Route::put('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.delete');
});

// admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin');

    Route::get('/films/table', [AdminController::class, 'filmsTable'])->name('admin.films');
    Route::get('/films/charts', [AdminController::class, 'filmsCharts'])->name('admin.films.charts');
});



// GET	/photos	index	photos.index
// GET	/photos/create	create	photos.create
// POST	/photos	store	photos.store
// GET	/photos/{photo}	show	photos.show
// GET	/photos/{photo}/edit	edit	photos.edit
// PUT/PATCH	/photos/{photo}	update	photos.update
// DELETE	/photos/{photo}	destroy	photos.destroy
