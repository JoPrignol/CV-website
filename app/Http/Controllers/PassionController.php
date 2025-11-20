<?php

namespace App\Http\Controllers;

use App\Models\Passion;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class PassionController extends Controller
{
  public function index(){
    $passions = Passion::all();

    $passions->each(function ($passion) {
        if ($passion->image) {
            $passion->image_url = Storage::url($passion->image);
        } else {
            $passion->image_url = null;
        }
    });

    return Inertia::render('Passions', [
      'passions' => $passions,
      'locale' => request()->cookie('locale', 'fr'),
    ]);
  }
}
