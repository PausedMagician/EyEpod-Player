<?php

use Illuminate\Support\Facades\Route;

$gets = [
    '/'=> 'index',
    '/Create Artist' => 'create',
];

foreach($gets as $path => $view) {
    Route::get($path, function() use ($view) {
        return view($view);
    });
}

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/Create Artist', function() {
//     return view('create');
// });