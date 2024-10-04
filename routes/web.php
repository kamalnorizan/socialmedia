<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\JqueryUiController;
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

// DB::listen(function ($event) {
//     dump($event->sql);
// });

Route::get('/', function () {
    return view('welcome');
});


Route::get('/posts/editor', [PostController::class, 'editor'])->name('posts.editor');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts/ajaxloadposts', [PostController::class, 'ajaxloadposts'])->name('posts.ajaxloadposts');

Route::get('jqueryui', [JqueryUiController::class,'index'])->name('jqueryui.index');

//routemi
// Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/{uuid}', [PostController::class, 'update'])->name('posts.update');
    Route::post('/posts/updateauthor/{uuid}', [PostController::class, 'updateauthor'])->name('posts.updateauthor');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('postdatatable', PostContr)->name('user');
