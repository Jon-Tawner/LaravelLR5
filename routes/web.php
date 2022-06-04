<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::middleware(['role:admin'])->group(function () {
        Route::get('blogs/load', [BlogController::class, 'load'])->name('load_blogs');
        Route::post('blogs/load', [BlogController::class, 'unpack'])->name('unpack_file_bogs');
    });

    Route::middleware(['role:user'])->group(function () {
        Route::get('blogs/my', [BlogController::class, 'my'])->name('my_blogs');
        Route::get('blogs/create', [BlogController::class, 'create'])->name('create_blog');
        Route::post('blogs', [BlogController::class, 'store'])->name('save_blog');
    });
    Route::get('blogs/edit/{blog}', [BlogController::class, 'edit'])->name('edit_blog');
    Route::get('blogs/delete/{blog}', [BlogController::class, 'delete'])->name('delete_blog');
    Route::put('blogs/update/{blog}', [BlogController::class, 'update'])->name('update_blog');
});
Route::get('blogs', [BlogController::class, 'index'])->name('all_blogs');
