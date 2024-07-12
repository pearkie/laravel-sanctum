<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('posts', PostController::class);
//     Route::post('comments', [CommentController::class, 'store']);
//     Route::put('comments/{comment}', [CommentController::class, 'update']);
//     Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
// });


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//JUST IN CASE!!!!

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
});
