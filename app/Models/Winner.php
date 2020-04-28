<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $table = 'winners';

    protected $fillable = [
      'name',
      'windate',
      'email',
      'birthday'
    ];
}