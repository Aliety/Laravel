<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'name', 'college', 'grade', 'content', 'type', 'place', 'week', 'number', 'level', 'requirement', 'profile'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('id', 'active', 'score');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function theses()
    {
        return $this->hasMany('App\Thesis');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
