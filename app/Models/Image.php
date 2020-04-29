<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Competition;

class Image extends Model
{
  protected $table = 'images';

  protected $fillable = [
    'src', 
    'alt'
  ];

  public function transaction()
  {
    return $this->belongsTo(Competition::class);
  }
}
