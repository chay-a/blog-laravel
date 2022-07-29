<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
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


Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.create');

Route::prefix('admin')->group(function () {
    Route::get('', [AdminArticleController::class, 'index'])->name('dashboard');
    Route::prefix('articles')->group(function () {
        Route::post('', [AdminArticleController::class, 'store'])->name('articles.store');
        Route::get('/create', [AdminArticleController::class, 'create'])->name('articles.create');
        Route::get('/{article}', [AdminArticleController::class, 'show'])->name('articles.show.admin');
        Route::get('/{article}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/{article}', [AdminArticleController::class, 'update'])->name('articles.update');
        Route::delete('/{article}', [AdminArticleController::class, 'destroy'])->name('articles.delete');
    });
    Route::prefix('comments')->group(function () {
        Route::get('/{comment}/edit', [AdminCommentController::class, 'edit'])->name('comments.edit');
        Route::put('/{comment}', [AdminCommentController::class, 'update'])->name('comments.update');
        Route::delete('/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.delete');
    });
});

require __DIR__.'/auth.php';
