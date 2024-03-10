<?php

use App\Http\Controllers\PVController;
use App\Livewire\Misposts;
use App\Livewire\MisVideos;
use App\Livewire\PaginaPrincipal;
use App\Livewire\Publicaciones;
use App\Models\Post;
use App\Models\Video;
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

/* Route::get('/', function () {
    return view('welcome');
})->name('home');
 */

Route::get('/', PaginaPrincipal::class)->name('home');

Route::get('show/post/{id}', [PVController::class, 'showPost'])->name('show.post');
Route::get('show/video/{id}', [PVController::class, 'showVideo'])->name('show.video');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('videos', MisVideos::class)->name('videos.index');
    Route::get('posts', Misposts::class)->name('posts.index');
});
