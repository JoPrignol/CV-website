<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'website_url',
    'logo'
  ];

  public function experiences()
  {
    return $this->hasMany(Experience::class);
  }
}
