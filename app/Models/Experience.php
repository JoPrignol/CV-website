<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
  use HasFactory;

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

  // Définir la relation avec le modèle Company
  public function company()
  {
    return $this->belongsTo(Company::class);
  }
}
