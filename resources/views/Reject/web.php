<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-submit', [LoginController::class, 'login_submit'])->name('login_submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/home/dashboard', [HomeController::class, 'index'])->name('home')->middleware('isAdmin:admin');
Route::get('/admin/profile', [RegisterController::class, 'profile'])->name('profile')->middleware('isAdmin:admin');
Route::get('/edit-profile', [ProfileController::class, 'index'])->name('edit_profile')->middleware('isAdmin:admin');
Route::post('/edit-profile-submit', [ProfileController::class, 'profile_submit'])->name('edit_profile_submit');



// Route::post('/post-submit', [PostController::class, 'post_submit'])->name('post_submit');

// routes/web.php

Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user_profile')->middleware('isAdmin:admin');



// Route::get('/home', [PostController::class, 'showAllPosts'])->name('home');
Route::post('/posts', [PostController::class, 'createPost'])->name('create_post');
Route::get('/posts/{postId}', [PostController::class, 'viewSinglePost'])->name('view_post');
Route::get('/posts/{postId}/edit', [PostController::class, 'editPost'])->name('edit_post');
Route::post('/posts/{postId}/update', [PostController::class, 'updatePost'])->name('update_post');
Route::get('/posts/{postId}/delete', [PostController::class, 'deletePost'])->name('delete_post');


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


// রাউটের স্ট্রাকচারটা হবে অনেকটা এরকম

// posts/{post}/comments/{comment}/edit

// এবং

// posts/{post}/comments/{comment}/update


// Route::middleware(['web'])->group(function () {
//     Route::get('/posts/{postId}/edit', [PostController::class, 'editPost'])->name('edit_post');
//     Route::put('/posts/{postId}', [PostController::class, 'updatePost'])->name('update_post');

