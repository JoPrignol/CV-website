<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('greeting', function () {
    return 'Hello World';
});

Route::get('/posts', function () {
  $posts =
    [
      1 => ['id' => 1, 'title' => 'First Post', 'content' => 'Lorem ipsum dolor sit amet'],
      2 => ['id' => 2, 'title' => 'Second Post', 'content' => 'Lorem ipsum dolor sit amet']
    ];
  return Inertia::render('Index', ['posts' => $posts]);
})->name('posts.index');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
