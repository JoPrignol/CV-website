<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Company extends Model
{
  use HasFactory;
  use HasTranslations;

  protected $fillable = [
    'name',
    'website_url',
    'logo'
  ];

  public array $translatable = [
    'name'
  ];

  protected $casts = [
    'name' => 'array',
    'website_url' => 'string',
    'logo' => 'string'
  ];

  public function experiences()
  {
    return $this->hasMany(Experience::class);
  }
}
