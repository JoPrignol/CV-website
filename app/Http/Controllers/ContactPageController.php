<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;

class ContactPageController extends Controller
{
  public function index(){
    $userContact = User::select('email', 'github_url', 'linkedin_url', 'phone_number')->first();
    return Inertia::render('Contact', ['userContact' => $userContact]);
  }
}
