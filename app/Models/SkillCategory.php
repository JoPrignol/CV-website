<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
class SkillCategory extends Model
{
  use HasFactory;
  use HasTranslations;

  protected $fillable = ['name'];

  protected $casts = [
      'name' => 'array',
  ];

  public array $translatable = [
      'name',
  ];

  public function skills(): HasMany
  {
      return $this->hasMany(Skill::class);
  }
}
