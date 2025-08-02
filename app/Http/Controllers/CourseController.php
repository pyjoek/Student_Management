<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();
        return view('course.course', compact('course'));
    }

    public function dashboard()
    {
        $course = Course::all();
        return view('admin', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $course = Course::create([
            'course' => $request->course,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::where('course_id', $id)->get();
        $course = Course::where('id', $id)->first();
        $lectures = User::where('role', 'lecture')->get();
        return view('course.list', compact(['course', 'lectures', 'students']));
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
