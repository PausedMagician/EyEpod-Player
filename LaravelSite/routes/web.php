<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\GenreController;
use App\Models\Artist;
use App\Http\Middleware\EnsureTokenIsValid;

function vview($view) {
    return function() use ($view) {
        return view($view);
    };
}


// Middleware for when the user is logged in
Route::middleware(EnsureTokenIsValid::class)->group(function() {
    Route::controller(ArtistController::class)->group(function() {
        Route::get('/create', [ArtistController::class, 'create']) -> name('artist.create');
        Route::post('/store',[ArtistController::class,'store']) -> name('artist.store');
        Route::get('/show/{id}', [ArtistController::class, 'show'])->name('artist.show');
    });
});

// Routes for user registration and login
// Route::get('/signup', vview("signup"))->name('signup');
// Route::get('/login', vview("login"))->name('login');

// For when the user is a guest
Route::controller(UserController::class)->group(function() {
    Route::get('/signup',  'signup')->name('signup');   
    Route::post('/signup',  'store')->name('signup');
   
    Route::get('/login',  'login')->name('login')->withoutMiddleware(EnsureTokenIsValid::class);
    Route::post('/login',  'authenticate')->name('login')->withoutMiddleware(EnsureTokenIsValid::class);
    
    Route::get('/logout',  'logout')->name('logout');
    Route::post('/logout',  'logout')->name('logout');

    Route::get('/', [ArtistController::class, 'index'])->name('artist.index');

});

// Route::middleware(EnsureTokenIsValid::class)->group(function() {
//     Route::get('/login', [UserController::class, 'login'])->name('login')-> withoutMiddleware(EnsureTokenIsValid::class);
// });

Route::controller(SongController::class)->prefix('song')->group(function() {
    Route::get('/create', [SongController::class, 'create'])->name('song.create');
    Route::post('/store', [SongController::class, 'store'])->name('song.store');
    Route::get('/get/{id}', [SongController::class, 'get'])->name('song.get');
});
Route::controller(SongController::class)->prefix('songs')->group(function() {
    Route::get('/get', [SongController::class, 'gets'])->name('songs.get');
});

Route::controller(GenreController::class)->prefix('genre')->group(function() {
    Route::get('/create', [GenreController::class, 'create'])->name('genre.create');
    Route::post('/store', [GenreController::class, 'store'])->name('genre.store');
    Route::get('/get/{id}', [GenreController::class, 'get'])->name('genre.get');
});
Route::controller(GenreController::class)->prefix('genres')->group(function() {
    Route::get('/get', [GenreController::class, 'gets'])->name('genres.get');
});
