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

    public function edit($id)
    {
        $pivotTable = CourseUniversity::where('id', $id)->first();
        $courses = Course::select('id', 'name')->where('status', 'Published')->get();
        $selectedCourses = Course::select('id', 'name')->where('id', $pivotTable->course_id)->where('status', 'Published')->first();
        return view('vendor.Voyager.universities.courseintake.edit', compact('id', 'courses', 'selectedCourses', 'pivotTable'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'course' => 'required',
            'intake' => 'required'
        ]);
        $course = $request->course;
        $intake = json_encode($request->intake);

        $university = CourseUniversity::find($request->id);
        $university->course_id = $course;
        $university->intake = $intake;
        $university->save();

        return redirect()->back()->with([
            'message'    => "Updated Data Successfully",
            'alert-type' => 'success',
        ]);


    }

    public function delete(Request $request)
    {
        $courseintake = CourseUniversity::find($request->id);
        $courseintake->delete();
        return redirect()->back()->with([
            'message'    => "Deleted Data Successfully",
            'alert-type' => 'success',
        ]);
    }
}
