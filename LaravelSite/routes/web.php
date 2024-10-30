<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Models\Artist;

function vview($view) {
    return function() use ($view) {
        return view($view);
    };
}


Route::get('/create', [ArtistController::class, 'create']) -> name('artist.create');

Route::post('/store',[ArtistController::class,'store']) -> name('artist.store');

Route::get('/show/{id}', [ArtistController::class, 'show'])->name('artist.show');

Route::get('/', [ArtistController::class, 'index'])->name('artist.index');


Route::get('/signup', vview("signup"))->name('signup');
Route::get('/login', vview("login"))->name('login');

