<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Course extends Model
{
  use HasFactory;

  protected $fillable = [
    'start_date',
    'end_date',
    'title',
    'description',
    'school_id',
  ];

  public function school()
  {
    return $this->belongsTo(School::class);
  }
}
