<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  protected $fillable = [
      'name',
      'description',
      'url',
      'main_image',
      'secondary_images'
  ];

  protected $casts = [
      'secondary_images' => 'array',
  ];

  public function tags()
  {
      return $this->belongsToMany(Tag::class, 'project_tag_junction');
  }
}
