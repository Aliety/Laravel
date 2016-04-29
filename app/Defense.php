<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defense extends Model
{
    protected $fillable = [
        'time', 'place', 'status', 'score'
    ];

    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Teacher')->withPivot('advice', 'score', 'role');
    }
}
