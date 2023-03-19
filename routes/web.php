<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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


Route::controller(AuthController::class)->group(function(){
    Route::get('/', 'index')->name('home');

    Route::get('login', 'index')->name('login');

    Route::get('registration', 'registration')->name('registration');

    Route::get('logout', 'logout')->name('logout');

    Route::post('validate_registration', 'validate_registration')->name('sample.validate_registration');

    Route::post('validate_login', 'validate_login')->name('sample.validate_login');
});


Route::middleware(['auth.check'])->group(function () {
    Route::get('dashboard',  [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('posts/show/{id}',  [PostController::class, 'show'])->name('posts.show');
    Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::post('comment/store', [CommentController::class, 'store'])->name('comment.store');
    Route::get('posts/delete/{id}',  [PostController::class, 'delete'])->name('posts.delete');
    Route::post('posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
});
