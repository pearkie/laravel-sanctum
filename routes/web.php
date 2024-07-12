<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\CommentController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/home', [PostController::class, 'index'])->name('home');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // Define the index route for posts

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::resource('posts', PostController::class)->except(['index']); // Exclude index route from resource route

    Route::resource('comments', CommentController::class)->except(['index', 'create', 'show', 'edit']);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
});
