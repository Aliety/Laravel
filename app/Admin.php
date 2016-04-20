<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token',
    ];
}
