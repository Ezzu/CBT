<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['statement','subsection_id','user_id','supervisor_id','user_time','supervisor_time','difficulty_level','maximum_age','current_age','priority','success_ratio','status'];

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function subsection(){
        return $this->belongsTo('App\Subsection');
    }

    public function options(){
        return $this->hasMany('App\Option');
    }

    public function sets(){
        return $this->belongsToMany('App\Set')->withTimestamps();
    }

    public function optionsAttempted(){
        return $this->belongsToMany('App\Option');
    }

    public function usersAttempted(){
        return $this->belongsToMany('App\User');
    }

}
