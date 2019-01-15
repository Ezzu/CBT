<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsection extends Model
{
    protected $fillable = ['name','section_id','number_of_questions','sequence_number'];

    public function section(){
        return $this->belongsTo('App\Section');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }
}
