<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('getcomments/{postID}', [CommentController::class,'get_comments'])->name('get-comments');
    Route::post('addcomments/{postID}', [CommentController::class,'add_comments'])->name('add-comments');
    Route::delete('deletecomments/{comment}', [CommentController::class,'delete_comments'])->middleware('can:delete,comment')->name('delete-comments');
    Route::post('updatecomments/{comment}', [CommentController::class,'update_comments'])->middleware('can:update,comment')->name('update-comments');

    Route::middleware('can:isAdmin')->group(function () {
        Route::match(['get', 'post'], 'edit-post/{post}', [PostController::class,'edit_post'])->name('post.edit');
        Route::match(['get', 'post'], 'add-post', [PostController::class,'add_post'])->name('post.add');
        Route::delete('deletepost/{post}', [PostController::class,'delete_post'])->name('post.delete');
    });
    
});

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::post('/', [AuthenticatedSessionController::class, 'store']);
});