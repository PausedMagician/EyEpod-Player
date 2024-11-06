<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\UserController;
use App\Models\Artist;
use App\Http\Middleware\EnsureTokenIsValid;

function vview($view) {
    return function() use ($view) {
        return view($view);
    };
}

Route::middleware(EnsureTokenIsValid::class)->group(function() {
    Route::controller(ArtistController::class)->group(function() {
        Route::get('/create', [ArtistController::class, 'create']) -> name('artist.create');
        Route::post('/store',[ArtistController::class,'store']) -> name('artist.store');
        Route::get('/show/{id}', [ArtistController::class, 'show'])->name('artist.show');
        Route::get('/', [ArtistController::class, 'index'])->name('artist.index');
    });
});

// Routes for user registration and login
// Route::get('/signup', vview("signup"))->name('signup');
// Route::get('/login', vview("login"))->name('login');

Route::controller(UserController::class)->group(function() {
    Route::get('/signup',  'signup')->name('signup');   
    Route::post('/signup',  'store')->name('signup');
   
    Route::get('/login',  'login')->name('login')->withoutMiddleware(EnsureTokenIsValid::class);
    //Route::post('/login',  'login')->name('login');
    Route::post('/login',  'authenticate')->name('login')->withoutMiddleware(EnsureTokenIsValid::class);
    
    Route::get('/logout',  'logout')->name('logout');
    Route::post('/logout',  'logout')->name('logout');
});

// Route::middleware(EnsureTokenIsValid::class)->group(function() {
//     Route::get('/login', [UserController::class, 'login'])->name('login')-> withoutMiddleware(EnsureTokenIsValid::class);
// });