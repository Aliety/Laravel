<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sex', 'birthday', 'grade', 'college', 'major', 'tel', 'profile',
    ];

    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function topics()
    {
        return $this->belongsToMany('App\Topic')->withPivot('id', 'active', 'score');
    }

    public function thesis()
    {
        return $this->hasOne('App\Thesis');
    }


}
