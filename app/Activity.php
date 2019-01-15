<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['name'];

    public function users(){
        return $this->belongsToMany('App\User')->withPivot('expired_at');
    }
}
