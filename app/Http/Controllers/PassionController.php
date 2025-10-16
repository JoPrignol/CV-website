<?php

namespace App\Http\Controllers;

use App\Models\Passion;
use Inertia\Inertia;

class PassionController extends Controller
{
  public function index(){
    $passions = Passion::all();
    return Inertia::render('Passions', ['passions' => $passions]);
  }
}
