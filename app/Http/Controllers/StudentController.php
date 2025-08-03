<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class StudentController extends Controller
{

    // AttendanceController.php

public function show()
{
    $user = auth()->user();

    $attendanceCount = Attendance::where('student_id', $user->id)->count();
    $today = now()->toDateString();

    $alreadyMarked = Attendance::where('student_id', $user->id)
                        ->whereDate('date', $today)
                        ->exists();

    return view('student', compact('attendanceCount', 'alreadyMarked'));
}

public function markAttendance(Request $request)
{
    $user = auth()->user();
    $date = $request->input('date', now()->toDateString());

    $alreadyMarked = Attendance::where('student_id', $user->id)
                        ->whereDate('date', $date)
                        ->exists();

    if (!$alreadyMarked) {
        Attendance::create([
            'user_id' => $user->id,
            'date' => $date,
            'status' => 'present',
        ]);
    }

    return redirect()->back()->with('success', 'Attendance marked successfully.');
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $user = auth()->user();
        $users = Student::all();
        $attendanceCount = Attendance::where('student_id', $user->id)->count();
        dd($attendanceCount);
        return view('student', compact(['users', 'attendanceCount']));
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
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'course_id' => $request->course_id,
            'password' => $request->password
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student'
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

}
