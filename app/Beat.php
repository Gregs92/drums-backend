<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beat extends Model
{

    protected $fillable = ['name', 'steps', 'bpm', 'repeats', 'layout'];

    protected $hidden = ['created_at', 'updated_at'];
}