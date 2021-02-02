<?php

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        $posts = Auth::user()->posts()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', [
            'posts' => $posts
        ]);
    })->name('dashboard');

    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';
