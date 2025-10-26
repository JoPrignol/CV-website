<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\PassionController;


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

Route::get('/contact', [ContactPageController::class, 'index'])->name('contact');

Route::get('/passions', [PassionController::class, 'index'])->name('passions');

// Route permettant de changer la langue de l'application
Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['fr', 'en', 'de'])) {
        abort(400);
    }

    Cookie::queue('locale', $locale, 60 * 24 * 30); // 30 jours
    return back();
})->name('lang.switch');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
