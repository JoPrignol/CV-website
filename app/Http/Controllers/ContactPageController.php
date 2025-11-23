<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ContactPageController extends Controller
{
  public function index(){
    $user = User::first();
    $userContact = User::select('email', 'github_url', 'linkedin_url', 'phone_number', 'profile_pic_url')->first();
    $userContact->profile_pic_url = $user->profile_pic
        ? Storage::url($user->profile_pic)
        : null;
    return Inertia::render('Contact', [
      'userContact' => $userContact,
      'locale' => request()->cookie('locale', 'fr'),
    ]);
  }
}
