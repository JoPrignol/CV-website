<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use App\Models\SkillCategory;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;


class HomepageController extends Controller
{
    public function index()
    {
        // Récupération des données de chaque modèle avec leurs relations
        $user = User::first(); // un seul utilisateur
        $categories = SkillCategory::with('skills')->get();
        $projects = Project::with('tags')->get();
        $experiences = Experience::with('company')->get();
        $courses = Course::with('school')->get();

        $user->profile_pic_url = $user->profile_pic
        ? Storage::url($user->profile_pic)
        : null;

        // Renvoi de toutes les données à la vue Inertia
        return Inertia::render('Homepage', [
            'user' => $user,
            'categories' => $categories,
            'projects' => $projects,
            'experiences' => $experiences,
            'courses' => $courses,
            'locale' => request()->cookie('locale', 'fr'),
        ]);
    }
}
