<?php

namespace App\Http\Controllers\API;

use App\Country;
use App\Course;
use App\Http\Controllers\Controller;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //DropDown University List According Country
    public function university(Request $request)
    {
        $countryId = $request->country_id;

        if(!empty($countryId)) {
            $university = Country::with('university')->find($countryId);
            $countryUniversity = $university->university->select('id', 'name');
        } else {
            $countryUniversity = University::select('id', 'name')->where('status', 'Published')->get();
        }

        return response()->json([
            'status' => 200,
            'university' => $countryUniversity
        ]);
    }
    //DropDown University List According Country

    //DropDown Course List According University
    public function course(Request $request)
    {
        $universityId = $request->university_id;

        if(!empty($universityId)) {
            $university = University::with('courses')->find($universityId);
            $universityCourses = $university->courses->select('id', 'name');
        } else {
            $universityCourses = Course::select('id', 'name')->where('status', 'Published')->get();
        }

        return response()->json([
            'status' => 200,
            'courses' => $universityCourses
        ]);
    }
    //DropDown University List According Country

    //DropDown Intake List According Course
    public function intake(Request $request)
    {
        $courseId = $request->course_id;

        if(!empty($courseId)) {
            $intakes = Course::where('status', 'Published')->find($courseId);
            $intakeMonth = json_decode($intakes->intake);
        }

        return response()->json([
            'status' => 200,
            'intake' => $intakeMonth
        ]);
    }
    //DropDown Intake List According Course

    //Search API
    public function search(Request $request)
    {
        $country = $request->country;
        $university = $request->university;
        $course = $request->course;
        $intake = $request->intake;
        $level = $request->level;

        $select = "countries.name as country, universities.name as university, courses.name as course, courses.intake as intake, levels.name as level";
        $join = 'JOIN universities ON countries.id = universities.country JOIN course_university ON universities.id = course_university.university_id JOIN courses ON course_university.course_id = courses.id JOIN course_level ON courses.id=course_level.course_id JOIN levels ON course_level.level_id = levels.id';
        $where = '';
        if(isset($country) && !empty($country)) {
            $where .= " AND countries.id=".$country;
        }

        if(isset($university) && !empty($university)) {
            $where .= " AND universities.id=".$university;
        }

        if(isset($course) && !empty($course)) {
            $where .= " AND courses.id=".$course;
        }

        if(isset($intake) && !empty($intake)) {
            $where .= " AND courses.intake LIKE '%".$intake."%'";
        }

        if(isset($level) && !empty($level)) {
            $where .= " AND levels.id=".$level;
        }


        $query = DB::select('SELECT '.$select.' FROM countries '.$join.' WHERE 1 '.$where);

        return response()->json([
            'status' => 200,
            'search' => $query
        ]);
    }
    //Search API
}
