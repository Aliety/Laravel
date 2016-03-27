<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Thesis extends Model
{
    protected $fillable = [
        'original_name', 'save_name', 'save_folder'
    ];
}
