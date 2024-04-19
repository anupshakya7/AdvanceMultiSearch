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

    public function store(Request $request){
        dd($request->all());
        $data = [];

        //Get the university id
        $university = $_POST['university'];

        //Get the arrays of courses and intakes
        $courses = $_POST['course'];
        $intakes = $_POST['intake'];
        dd($intakes);

        for($i=0;$i<count($courses);$i++){
            $entry = [
                "_token"=> $_POST['_token'],
                "university"=>$university,
                "course"=>$courses[$i],
                "intake"=>$intakes[$i]
            ];

            //Add the entry to the $data array
            $data[] = $entry;
        }
        dd($data);
    }
}
