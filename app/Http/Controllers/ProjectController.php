<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
  public function index(){
    $projects = Project::with('tags')->get();

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
    ]);
  }
}
