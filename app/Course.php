<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    public function universities(){
        return $this->belongsToMany(University::class,'course_university','course_id','university_id');
    } 
}
