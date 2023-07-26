<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;

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

Route::get('/', function () {
    return view('welcome');
})->name('top');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

// ログイン後の通常のユーザー画面
Route::middleware(['verified'])->group(function(){
    Route::get('post/mypost', [PostController::class, 'mypost'])->name('post.mypost');
    Route::get('post/mycomment', [PostController::class, 'mycomment'])->name('post.mycomment');
    Route::resource('post', PostController::class);
    Route::post('post/comment/store',[CommentController::class, 'store'])->name('comment.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // 管理者用画面
    Route::middleware(['auth', 'can:admin'])->group(function () {
        Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
    });
});



//↓同じコントローラを使用する時のまとめる書き方
// Route::controller(ContactController::class)->group(function(){
//     Route::get('contact/create', 'create')->name('contact.create');
//     Route::post('contact/store', 'store')->name('contact.store');
// });




require __DIR__.'/auth.php';
