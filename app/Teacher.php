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
}
