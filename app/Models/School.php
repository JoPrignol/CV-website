<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class School extends Model
{
  use HasFactory;
  use HasTranslations;

  protected $fillable = [
    'name',
    'website_url',
    'logo',
    'location'
  ];

  public array $translatable = [
    'name',
    'location',
  ];

  protected $casts = [
    'name' => 'array',
    'website_url' => 'string',
    'logo' => 'string',
    'location' => 'array'
  ];

  public function courses()
  {
    return $this->hasMany(Course::class);
  }
}
