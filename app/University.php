<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class University extends Model
{
    public function courses(){
        return $this->belongsToMany(Course::class,'course_university','university_id','course_id');
    }
}
