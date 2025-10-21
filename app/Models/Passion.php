<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Passion extends Model
{
  use HasFactory;
  use HasTranslations;
    protected $fillable = [
      'name',
      'description',
      'image'
  ];

  public array $translatable = [
      'name',
      'description',
  ];

  protected $casts = [
      'name' => 'array',
      'description' => 'array',
      'image' => 'string'
  ];
}
