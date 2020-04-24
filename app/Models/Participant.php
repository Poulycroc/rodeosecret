<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Competition;

class Participant extends Model
{
    protected $table = 'participants';

    protected $fillable = [
      'name',
      'status',
      'email',
      'birthday'
    ];

    public function competitions() {
      return $this->belongsToMany(Competition::class, 'competition_participant');
    }
}