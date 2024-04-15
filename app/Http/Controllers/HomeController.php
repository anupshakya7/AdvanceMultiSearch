<?php

namespace App\Http\Controllers;

use App\Country;
use App\Course;
use App\Level;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $countries = Country::where('status','Published')->get();
        $universities = University::where('status','Published')->get();
        $courses = Course::where('status','Published')->get();
        $levels = Level::where('status','Published')->get();
        $results = DB::select('SELECT countries.name as country, universities.name as university, courses.name as course, courses.intake as intake, levels.name as level FROM countries JOIN universities ON countries.id = universities.country JOIN course_university ON universities.id = course_university.university_id JOIN courses ON course_university.course_id = courses.id JOIN course_level ON courses.id=course_level.course_id JOIN levels ON course_level.level_id = levels.id;');

        return view('home',compact('countries','universities','courses','levels','results'));
    }
}
