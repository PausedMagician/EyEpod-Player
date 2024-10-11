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

Route::get('/audio/{id}', function($id) {
    // REST API from here
    header('Content-Type: audio/mpeg');
    $file = file_get_contents(public_path() . '/audio/'.$id.'.mp3');
    echo $file;
});

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/Create Artist', function() {
//     return view('create');
// });