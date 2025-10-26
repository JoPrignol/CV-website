<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Experience extends Model
{
  use HasFactory;
  use HasTranslations;

  // Permet de définir les champs pouvant être remplis en masse
  // (les champs non inclus ici ne pourront pas être remplis via une assignation de masse)
  protected $fillable = [
    'start_date',
    'end_date',
    'position',
    'description',
    'location',
    'company_id'
  ];

  public array $translatable = [
    'position',
    'description',
    'location',
  ];

  protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
    'position' => 'array',
    'description' => 'array',
    'location' => 'array',
  ];

  // Définir la relation avec le modèle Company
  public function company()
  {
    return $this->belongsTo(Company::class);
  }
}
