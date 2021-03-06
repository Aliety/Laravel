<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    protected $fillable = [
        'name', 'college', 'major', 'title', 'tel', 'profile'
    ];

    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }

    public function theses()
    {
        return $this->hasMany('App\Thesis');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function defenses()
    {
        return $this->belongsToMany('App\Defense')->withPivot('advice', 'score', 'role');
    }
}
