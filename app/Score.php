<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['user_id', 'beat_id', 'score'];

    protected $hidden = ['created_at', 'updated_at'];
}
