<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
  public function index(){
    $experiences = Experience::with('company')->get();
    $experiences->each(function ($exp) {
            if ($exp->company && $exp->company->logo) {
                $exp->company->logo_url = Storage::url($exp->company->logo);
            } else {
                $exp->company->logo_url = null;
            }
        });
    return Inertia::render('Experiences', [
      'experiences' => $experiences,
      'locale' => request()->cookie('locale', 'fr'),
    ]);
  }
}
