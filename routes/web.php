<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthorController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;


Route::middleware(['web'])->group(function () {


    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login-submit', [LoginController::class, 'login_submit'])->name('login_submit');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Routes requiring 'isAdmin' middleware
    Route::middleware(['isAdmin:admin'])->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('home');
=======
use App\Http\Controllers\BartaControllers\HomeController;
use App\Http\Controllers\BartaControllers\PostController;
use App\Http\Controllers\BartaControllers\UserController;
use App\Http\Controllers\BartaControllers\AuthorController;
use App\Http\Controllers\BartaControllers\CommentController;
use App\Http\Controllers\BartaControllers\ProfileController;
use App\Http\Controllers\BartaControllers\Admin\LoginController;
use App\Http\Controllers\BartaControllers\Admin\RegisterController;

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

Route::get('/', function () {
    return redirect()->route('home');
});

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/home', [HomeController::class, 'index'])->name('home');
>>>>>>> c401750 (Initial commit for assignment-3)

        Route::get('/admin/profile', [RegisterController::class, 'profile'])->name('profile');
        Route::get('/edit-profile', [ProfileController::class, 'index'])->name('edit_profile');
        Route::post('/edit-profile-submit', [ProfileController::class, 'profile_submit'])->name('edit_profile_submit');
        Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user_profile');
        Route::get('/view/{id}/single/profile', [AuthorController::class, 'viewSingleProfile'])->name('view_single_profile');

        Route::get('/posts/{postId}', [PostController::class, 'viewSinglePost'])->name('view_post');
        Route::post('/posts', [PostController::class, 'createPost'])->name('create_post');
        Route::get('/posts/{postId}/edit', [PostController::class, 'editPost'])->name('edit_post');
        Route::post('/posts/{postId}/update', [PostController::class, 'updatePost'])->name('update_post');
        Route::get('/posts/{postId}/delete', [PostController::class, 'deletePost'])->name('delete_post');

<<<<<<< HEAD
    });

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

=======

        // Route::get('/comments/{postId}', [CommentController::class, 'viewSingleComment'])->name('view_comment');
        Route::post('/comments', [CommentController::class, 'createCommant'])->name('create_comment');
        Route::get('/comments/{commentId}/edit', [CommentController::class, 'editComment'])->name('edit_comment');
        Route::post('/comments/{commentId}/update', [CommentController::class, 'updateComment'])->name('update_comment');
        Route::get('/comments/{commentId}/delete', [CommentController::class, 'deleteComment'])->name('delete_comment');


});

require __DIR__.'/auth.php';

>>>>>>> c401750 (Initial commit for assignment-3)
