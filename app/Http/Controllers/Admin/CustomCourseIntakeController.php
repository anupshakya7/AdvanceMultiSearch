<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\CourseUniversity;
use App\Http\Controllers\Controller;
use App\University;
use Illuminate\Http\Request;

class CustomCourseIntakeController extends Controller
{
    public function index()
    {
        $universities = University::select('id', 'name')->where('status', 'Published')->get();
        $courses = Course::select('id', 'name')->where('status', 'Published')->get();

        return view('vendor.Voyager.universities.custom-courseintake', compact('universities', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'university' => 'required',
            'course' => 'required',
            'intake' => 'required'
        ]);

        $university = $request->university;
        $courses = $request->course;
        $intakes = $request->intake;

        CourseUniversity::where('university_id', $university)->delete();

        foreach($courses as $course) {
            $intake = json_encode($intakes[$course]);
            CourseUniversity::create([
                'university_id' => $university,
                'course_id' => $course,
                'intake' => $intake
            ]);
        }

        return redirect()->back()->with([
            'message'    => "Added Data Successfully",
            'alert-type' => 'success',
        ]);

    }
}
