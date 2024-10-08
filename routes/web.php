<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\JqueryUiController;
use App\Http\Controllers\Google2FaController;
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


Route::get('google2fa/enable', [Google2FaController::class,'index'])->name('google2fa.register');
Route::get('google2fa/verifyForm', [Google2FaController::class,'verifyForm'])->name('google2fa.verifyForm');
Route::get('google2fa/sendmail', [Google2FaController::class,'sendmail'])->name('google2fa.sendmail');
Route::get('google2fa/resetandregister/{user}', [Google2FaController::class,'resetandregister'])->name('google2fa.resetandregister');
Route::post('google2fa/verify', [Google2FaController::class,'verify'])->name('google2fa.verify');
Route::get('google2fa/registration', [Google2FaController::class,'completeregistration'])->name('complete.registration');

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
