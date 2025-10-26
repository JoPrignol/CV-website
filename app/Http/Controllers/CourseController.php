<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Inertia;

class CourseController extends Controller
{
  public function index(){
    $courses = Course::with('school')->get();
    return Inertia::render('Courses', [
      'courses' => $courses,
      'locale' => request()->cookie('locale', 'fr'),
    ]);
  }
}
