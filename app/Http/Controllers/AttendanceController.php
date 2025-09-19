<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Course;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $dates = Attendance::select('date')->distinct()->orderBy('date', 'desc')->pluck('date');
        return view('lecture.new.attendance', compact('dates'));
    }

public function dashboard()
{
    $user = \Illuminate\Support\Facades\Auth::user();

    // Find the student record for the logged-in user
    $student = \App\Models\Student::where('name', $user->name)->first();

    if (!$student) {
        return redirect()->back()->with('error', 'Student record not found.');
    }

    $fromDate = \Carbon\Carbon::now()->subDays(30);

    // Count distinct days attended in the last 30 days
    $attendedDays = \App\Models\Attendance::where('student_id', $student->id)
        ->where('status', 'present')
        ->where('date', '>=', $fromDate)
        ->distinct('date')
        ->count('date');

    $totalDays = 30;
    $missedDays = max($totalDays - $attendedDays, 0);

    return view('student.dashboard', compact(
        'totalDays',
        'attendedDays',
        'missedDays'
    ));
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

    public function show($date = null)
    {
        // If no date is passed, default to today's date
        if (!$date) {
            $date = now()->format('Y-m-d'); // Default to today's date
        }

        $selectedDate = $date;
        $dates = Attendance::select('date')->distinct()->pluck('date');

        // Attendance for the selected date
        $attendanceData = Attendance::with('student')->where('date', $selectedDate)->get();

        // Check if there is no attendance data for the selected date
        if ($attendanceData->isEmpty()) {
            // If no data, pass a flag or message
            $attendanceData = null;  // or pass a message like 'No data available for this date'
        }

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

        return view('lecture.new.attendance', compact(
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

        return view('student.report', compact('attendances', 'totalPresent', 'attendancePercentage'));
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

        return view('lecture.reports', compact('students'));
    }

    public function exportPdf()
    {
        $fromDate = Carbon::now()->subDays(30);
        $students = Student::all()->map(function ($student) use ($fromDate) {
            $presentDays = Attendance::where('student_id', $student->id)
                ->where('status', 'present')
                ->where('date', '>=', $fromDate)
                ->distinct('date')
                ->count('date');

            $totalDays = 30;
            $percentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 2) : 0;

            $student->totalDays = $totalDays;
            $student->presentDays = $presentDays;
            $student->percentage = $percentage;

            return $student;
        });

        $pdf = PDF::loadView('lecture.report-pdf', compact('students'));

        return $pdf->download('attendance_report.pdf');
    }
}
