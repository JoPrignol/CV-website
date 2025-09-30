<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('greeting', function () {
    return 'Hello World';
});

// Test à supprimer
Route::get('/posts', function () {
  $posts =
    [
      1 => ['id' => 1, 'title' => 'First Post', 'content' => 'Lorem ipsum dolor sit amet'],
      2 => ['id' => 2, 'title' => 'Second Post', 'content' => 'Lorem ipsum dolor sit amet']
    ];
  return Inertia::render('Index', ['posts' => $posts]);
})->name('posts.index');

Route::get('/skills', [SkillController::class, 'index']);

Route::get('/experiences', [ExperienceController::class, 'index']);

Route::get('/schools', [SchoolController::class, 'index']);

Route::get('/courses', [CourseController::class, 'index']);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
