<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('post', PostController::class)->middleware("auth"); 
Route::post('/comment/{postId}', [CommentController::class, 'store'])->name('comment.store')->middleware("auth");
Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware("auth");
Route::post('/like/{postId}', [LikeController::class, 'create'])->name('like.create')->middleware("auth");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
