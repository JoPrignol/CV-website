<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
class Tag extends Model
{
  use HasFactory;
  use HasTranslations;

  protected $fillable = [
    'name',
    'spotlight'
  ];

  public array $translatable = [
    'name',
  ];

  protected $casts = [
    'name' => 'array',
    'spotlight' => 'boolean'
  ];

  public function projects()
  {
      return $this->belongsToMany(Project::class, 'project_tag_junction');
  }
}
