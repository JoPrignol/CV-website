<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Inertia\Inertia;

class ExperienceController extends Controller
{
  public function index(){
    $experiences = Experience::with('company')->get();
    return Inertia::render('Experiences', [
      'experiences' => $experiences,
      'locale' => request()->cookie('locale', 'fr'),
    ]);
  }
}
