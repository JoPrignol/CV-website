<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SkillCategory;

class SkillController extends Controller
{
  public function index(){
    $categories = SkillCategory::with('skills')->get();
    return Inertia::render('Skills', ['categories' => $categories]);
  }
}
