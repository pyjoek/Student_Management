<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $dates = Attendance::select('date')->distinct()->orderBy('date', 'desc')->pluck('date');
        return view('new.attendance', compact('dates'));
    }

    public function showd($date)
    {
        $dates = Attendance::select('date')->distinct()->orderBy('date', 'desc')->pluck('date');
        $attendanceData = Attendance::with('student')->where('date', $date)->get();

        return view('new.attendance', [
            'dates' => $dates,
            'attendanceData' => $attendanceData,
            'selectedDate' => $date
        ]);
    }
    // AttendanceController.php
    // public function index()
    // {
    //      $user = auth()->user();
    //     $users = Student::all();
    //     $attendanceCount = Attendance::where('student_id', $user->id)->count();
    //     return view('student', compact(['users', 'attendanceCount']));
    // }

    // public function show()
    // {
    //     $user = auth()->user();

    //     $id = Student::where('name',$user->name)->first();
    //     $attendanceCount = Attendance::where('student_id', $id)->count();
    //     $today = now()->toDateString();

    //     $alreadyMarked = Attendance::where('student_id', $id)
    //                         ->whereDate('date', $today)
    //                         ->exists();

    //     return view('new.attendance', compact('attendanceCount', 'alreadyMarked'));
    // }

    public function show($date)
{
    $selectedDate = $date;
    $dates = Attendance::select('date')->distinct()->pluck('date');

    // Attendance for the selected date
    $attendanceData = Attendance::with('student')->where('date', $selectedDate)->get();

    // Check low attendance
    $lowAttendanceStudents = [];
    $students = Student::all();

    foreach ($students as $student) {
        $total = Attendance::where('student_id', $student->id)->count();
        $present = Attendance::where('student_id', $student->id)->where('status', 'present')->count();

        $percentage = $total > 0 ? round(($present / $total) * 100, 2) : 0;

        if ($percentage < 50) {
            $lowAttendanceStudents[] = [
                'name' => $student->name,
                'percentage' => $percentage,
            ];
        }
    }

    return view('new.attendance', compact(
        'dates',
        'selectedDate',
        'attendanceData',
        'lowAttendanceStudents'
    ));
}


    public function markAttendance(Request $request)
    {
        $user = auth()->user();
        $id = Student::where('name',$user->name)->first();
        $date = $request->input('date', now()->toDateString());

        $alreadyMarked = Attendance::where('student_id', $id)
                            ->whereDate('date', $date)
                            ->exists();

        if (!$alreadyMarked) {
            Attendance::create([
                'student_id' => $id->id,
                'date' => $date,
                'status' => 'present',
            ]);
        }

        return redirect()->back()->with('success', 'Attendance marked successfully.');
    }

    /**
     * Display a listing of the resource.
     */
    public function indexd()
    {
        $users = Student::all();
        return view('new.attendance', compact(['users']));
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
        $data = Attendance::create([
            'student_id' => $request->student_id,
            'status' => $request->status,
            'date' => $request->date
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function report()
   {
    $user = Auth::user();

    // Step 1: Find the student by name
    $student = Student::where('name', $user->name)->first();

    if (!$student) {
        return redirect()->back()->with('error', 'Student record not found.');
    }

    // Step 2: Get attendance using student ID
    $attendances = Attendance::where('student_id', $student->id)
        ->orderBy('date', 'desc')
        ->get();

    // Step 3: Attendance calculations
    $totalPresent = $attendances->where('status', 'present')->count();
    $totalDays = 30; // or fixed 30, depending on how you define it

    $attendancePercentage = $totalDays > 0
        ? round(($totalPresent / $totalDays) * 100, 2)
        : 0;

    return view('report', compact('attendances', 'totalPresent', 'attendancePercentage'));
}

    public function adminReport()
   {
    $users = User::where('role', 'student')->get();

    $students = $users->map(function ($user) {
        // Match user by name to student
        $student = Student::where('name', $user->name)->first();

        if (!$student) {
            return (object)[
                'name' => $user->name,
                'totalDays' => 0,
                'presentDays' => 0,
                'percentage' => 0,
            ];
        }

        $totalDays = 30; // or Attendance::where('student_id', $student->id)->count();
        $presentDays = Attendance::where('student_id', $student->id)
                                 ->where('status', 'present')
                                 ->count();

        $percentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 2) : 0;

        return (object)[
            'name' => $user->name,
            'totalDays' => $totalDays,
            'presentDays' => $presentDays,
            'percentage' => $percentage,
        ];
    });

    return view('reports', compact('students'));
}
}
