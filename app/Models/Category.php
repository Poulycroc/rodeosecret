<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Competition;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    public function competitions() {
      return $this->belongsTo(Competition::class, 'category_id');
    }
}