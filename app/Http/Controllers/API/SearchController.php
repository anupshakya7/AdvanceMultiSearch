<?php

namespace App\Http\Controllers\API;

use App\Country;
use App\Course;
use App\Http\Controllers\Controller;
use App\University;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //DropDown University List According Country
    public function university(Request $request){
        $countryId = $request->country_id;

        if(!empty($countryId)){
            $university = Country::with('university')->find($countryId);
            $countryUniversity = $university->university->select('id','name');
        }else{
            $countryUniversity = University::select('id','name')->where('status','Published')->get();
        }
        
        return response()->json([
            'status'=>200,
            'university'=> $countryUniversity
        ]);
    }
    //DropDown University List According Country

    //DropDown Course List According University
    public function course(Request $request){
        $universityId = $request->university_id;

        if(!empty($universityId)){
            $university = University::with('courses')->find($universityId);
            $universityCourses = $university->courses->select('id','name');
        }else{
            $universityCourses = Course::select('id','name')->where('status','Published')->get();
        }
        
        return response()->json([
            'status'=>200,
            'courses'=> $universityCourses
        ]);
    }
    //DropDown University List According Country

    //DropDown Intake List According Course
    public function intake(Request $request){
        $courseId = $request->course_id;

        if(!empty($courseId)){
            $intakes = Course::where('status','Published')->find($courseId);
            $intakeMonth = json_decode($intakes->intake);
        }
        
        return response()->json([
            'status'=>200,
            'intake'=> $intakeMonth
        ]);
    }
    //DropDown Intake List According Course
}
