<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passion extends Model
{
    protected $fillable = [
      'name',
      'description',
      'image'
  ];
}
