<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
  use HasFactory;
  use HasTranslations;

  protected $fillable = [
      'name',
      'description',
      'url',
      'main_image',
      'secondary_images'
  ];

  public array $translatable = [
    'name',
    'description',
  ];

  protected $casts = [
    'name' => 'array',
    'description' => 'array',
    'url' => 'string',
    'main_image' => 'string',
    'secondary_images' => 'array'
  ];

  public function tags()
  {
      return $this->belongsToMany(Tag::class, 'project_tag_junction');
  }
}
