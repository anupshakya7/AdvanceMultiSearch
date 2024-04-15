<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CourseLevel extends Model
{
    protected $table="course_level";
    protected $fillable = ['course_id','level_id'];
}
