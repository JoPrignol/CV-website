<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
class Skill extends Model
{
  use HasFactory;
  use HasTranslations;

  protected $fillable = [
    'name',
    'level',
    'skill_category_id'
  ];

  public array $translatable = [
    'name',
  ];

  protected $casts = [
    'name' => 'array',
    'level' => 'integer',
  ];

  public function category(): BelongsTo
  {
      return $this->belongsTo(SkillCategory::class, 'skill_category_id');
  }
}
