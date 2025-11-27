<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  public function index(Request $request){
    $projects = Project::with('tags')->get();

    // 1. Récupère l'ID du tag depuis l'URL (si présent)
    $activeTagId = $request->query('tag');

    $projects->each(function ($project) {
        if ($project->main_image) {
            $project->main_image_url = Storage::url($project->main_image);
        } else {
            $project->main_image_url = null;
        }

        if ($project->secondary_images) {
            $project->secondary_images_urls = array_map(function ($imagePath) {
                return Storage::url($imagePath);
            }, $project->secondary_images);
        } else {
            $project->secondary_images_urls = [];
        }
    });
    return Inertia::render('Projects', [
      'projects' => $projects,
      'locale' => request()->cookie('locale', 'fr'),
      'initialActiveTag' => $activeTagId ?? null,
    ]);
  }
}
