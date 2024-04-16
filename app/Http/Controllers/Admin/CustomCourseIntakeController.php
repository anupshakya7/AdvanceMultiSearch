<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\University;
use Illuminate\Http\Request;

class CustomCourseIntakeController extends Controller
{
    public function index(){
        $universities = University::select('id','name')->where('status','Published')->get();
        $courses = Course::select('id','name')->where('status','Published')->get();

        return view('vendor.Voyager.universities.custom-courseintake',compact('universities','courses'));
    }
}
