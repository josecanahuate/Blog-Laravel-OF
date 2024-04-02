<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/* Route::get('/', function () {
    return view('welcome');
});
 */

Route::get('/', [PostController::class, 'index'])->name('posts.index'); //listado de posts
Route::get('post/{post}', [PostController::class, 'show'])->name('posts.show'); //detalles del post
Route::get('category/{category}', [PostController::class, 'category'])->name('posts.category'); //blog por categoría
Route::get('tag/{tag}', [PostController::class, 'tag'])->name('posts.tag'); //tags

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
