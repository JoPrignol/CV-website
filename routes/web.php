<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomepageController;


Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('greeting', function () {
    return 'Hello World';
});

Route::get('/skills', [SkillController::class, 'index']);

Route::get('/experiences', [ExperienceController::class, 'index']);

// Route::get('/schools', [SchoolController::class, 'index']);

Route::get('/courses', [CourseController::class, 'index']);

Route::get('/projects', [ProjectController::class, 'index'], 'index');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
