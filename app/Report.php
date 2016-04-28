<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'advice', 'original_name', 'save_name', 'save_folder', 'teacher_id', 'active'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
