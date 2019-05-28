<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'title',
        'line',
        'wistya_project_id',
        'course_id',
    ];
    
    public $timestamps = true;
}
