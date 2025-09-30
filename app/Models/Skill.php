<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
  protected $fillable = [
    'name',
    'level',
    'skill_category_id'
  ];

  public function category(): BelongsTo
  {
      return $this->belongsTo(SkillCategory::class, 'skill_category_id');
  }
}
