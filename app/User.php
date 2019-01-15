<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'test_grant', 'set'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public function questions(){
        return $this->belongsToMany('App\Question');
    }

    public function activities(){
        return $this->belongsToMany('App\Activity')->withTimestamps()->withPivot('expired_at');
    }

}
