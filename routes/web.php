<?php

// Route halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Include route lain
require __DIR__.'/todo.php';
require __DIR__.'/note.php'; 
