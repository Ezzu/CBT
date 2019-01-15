<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name','subject_id','number_of_questions'];

    public function subject(){
        return $this->belongsTo('App\Subject');
    }
}
