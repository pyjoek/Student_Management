<?php

namespace App\Http\Controllers;

use App\Models\Marks;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    // public function store(Request $request)
    // {
    //     $mark = Marks::create([
    //         'student' => $request->student,
    //         'course' => $request->course,
    //         'module' => $request->module,
    //         'marks' => $request->marks
    //     ]);

    //     return redirect()->back();
    // }

    public function store(Request $request)
    {
        $data = $request->input('marks');

        foreach ($data as $entry) {
            Marks::create([
                'student' => $entry['student'],
                'course' => $entry['course'],
                'module' => $entry['module'],
                'marks' => $entry['marks'],
            ]);
        }

        return redirect()->back()->with('success', 'All marks submitted successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Marks $marks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marks $marks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marks $marks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marks $marks)
    {
        //
    }
}
