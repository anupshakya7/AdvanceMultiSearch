<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseUniversity extends Model
{
    protected $table = "course_university";
    protected $fillable = ['id','university_id','course_id','intake'];
}
