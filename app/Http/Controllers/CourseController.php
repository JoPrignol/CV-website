<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
  public function index(){
    $courses = Course::with('school')->get();

    $courses->each(function ($course) {
        if ($course->school && $course->school->logo) {
            $course->school->logo_url = Storage::url($course->school->logo);
        } else {
            $course->school->logo_url = null;
        }
    });
    return Inertia::render('Courses', [
      'courses' => $courses,
      'locale' => request()->cookie('locale', 'fr'),
    ]);
  }
}
