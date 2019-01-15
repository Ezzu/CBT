<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['question_id','option','key'];

    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function usersAttempted(){
        return $this->belongsToMany('App\User');
    }

    public function questionsAttempted(){
        return $this->belongsToMany('App\User','option_question_user');
    }

}
