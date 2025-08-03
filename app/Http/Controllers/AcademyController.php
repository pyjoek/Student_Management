<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class AcademyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();
        $student = Student::all();
        
        return view('academic.academic', compact(['course', 'student']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function marks()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mod = Academy::create([
            'course_id' => $request->course,
            'module' => $request->module
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Academy $academy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academy $academy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academy $academy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academy $academy)
    {
        //
    }
}
