<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'teacher_id', 'user_id', 'content'
    ];
}
