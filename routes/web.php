<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\SongAlbumController;
use App\Http\Controllers\AlbumSongController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('songs', SongController::class)->except(['index', 'show']); // Songs
    Route::resource('bands', BandController::class)->except(['index', 'show']); // Bands
    Route::resource('albums', AlbumController::class)->except(['index', 'show']); // Albums

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('albums/{album}/song/{song}/add', [AlbumSongController::class, 'attachSong'])->name('album.song.attach');
    Route::delete('albums/{album}/song/{song}/remove', [AlbumSongController::class, 'detachSong'])->name('album.song.detach');

    Route::post('songs/{song}/album/{album}/add', [SongAlbumController::class, 'attachAlbum'])->name('song.album.attach');
    Route::delete('songs/{song}/album/{album}/remove', [SongAlbumController::class, 'detachAlbum'])->name('song.album.detach');
});

require __DIR__ . '/auth.php';

Route::resource('songs', SongController::class)->only(['index', 'show']); // Songs
Route::resource('bands', BandController::class)->only(['index', 'show']); // Bands
Route::resource('albums', AlbumController::class)->only(['index', 'show']); // Albums
