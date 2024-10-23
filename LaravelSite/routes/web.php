<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Models\Artist;

Route::get('/', [ArtistController::class, 'index']) -> name('artist.index');

Route::get('/create', [ArtistController::class, 'create'])->name('artist.create');

Route::post('/', [ArtistController::class, 'store'])->name('artist.store');