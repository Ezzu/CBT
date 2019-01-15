<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = ['name'];

    public function questions(){
        return $this->belongsToMany('App\Question')->withTimestamps();
    }
}
