<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // AttendanceController.php

    public function show()
    {
        $user = auth()->user();

        $id = Student::where('name',$user->name)->first();
        $attendanceCount = Attendance::where('student_id', $id)->count();
        $today = now()->toDateString();

        $alreadyMarked = Attendance::where('student_id', $id)
                            ->whereDate('date', $today)
                            ->exists();

        return view('student', compact('attendanceCount', 'alreadyMarked'));
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
    public function index()
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

        $attendances = Attendance::where('student_id', $user->id)
                        ->orderBy('date', 'desc')
                        ->get();

        $totalPresent = $attendances->where('status', 'present')->count();
        $totalDays = $attendances->count();

        $attendancePercentage = $totalDays > 0
            ? round(($totalPresent / $totalDays) * 100, 2)
            : 0;

        return view('report', compact('attendances', 'totalPresent', 'attendancePercentage'));
    }

    public function adminReport()
    {
        $users = User::where('role', 'student')->get(); // Adjust if you're using roles

        $students = $users->map(function ($user) {
            $totalDays = Attendance::where('student_id', $user->id)->count();
            $presentDays = Attendance::where('student_id', $user->id)->where('status', 'present')->count();
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
