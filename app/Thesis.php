<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Thesis extends Model
{
    protected $fillable = [
        'original_name', 'save_name', 'save_folder', 'teacher_id'
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
