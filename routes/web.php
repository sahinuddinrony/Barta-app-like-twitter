<?php

use Illuminate\Support\Facades\Route;
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

    });

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

