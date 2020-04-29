<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\User;
use App\Models\Participant;
use App\Models\Image;

class Competition extends Model
{
    protected $table = 'competitions';
    
    protected $fillable = [
      'title',
      'type',
      'in_landing',
      'on_top',
      'publication',
      'start_event',
      'description'
    ];

    public function category()
    {
      return $this->hasOne(Category::class);
    }

    public function participants()
    {
      return $this->belongsToMany(Participant::class, 'competition_participant');
    }

    public function image() 
    {
        return $this->hasOne(Image::class);
    }
}