<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{
  use HasFactory;
  use HasTranslations;


  protected $fillable = [
    'start_date',
    'end_date',
    'title',
    'description',
    'school_id',
  ];

  public array $translatable = [
    'title',
    'description',
  ];

  protected $casts = [
    'title' => 'array',
    'description' => 'array',
    'start_date' => 'date',
    'end_date' => 'date',
  ];

  public function school()
  {
    return $this->belongsTo(School::class);
  }
}
