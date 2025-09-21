<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();
        return view('lecture.course.course', compact('course'));
    }

    public function dashboard()
    {
        $totalUsers    = User::count();
        $totalLectures = User::where('role', 'admin')->count();
        $totalStudents = Student::count();
        $totalCourses  = Course::count();

        $studentsByDay = Student::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $studentsByDay->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M'));
        $counts = $studentsByDay->pluck('count');
        // $counts = [$counts, 100];
        
        // Attendance Today
        $today = Carbon::today();
        
        $attendedToday = Attendance::whereDate('date', $today)
        ->where('status', 'present')
        ->count();
        
        $expectedStudents = 30; // set fixed total expected students
        $absentToday = max($expectedStudents - $attendedToday, 0);
        
        $attendanceLabels = ['Present', 'Absent'];
        $attendanceCounts = [$attendedToday, $absentToday];

        return view('lecture.dashboard', compact(
            'totalUsers',
            'totalLectures',
            'totalStudents',
            'totalCourses',
            'labels',
            'counts',
            'attendanceLabels',
            'attendanceCounts',
            'expectedStudents'
        ));
    }

    public function profile()
    {
        $course = Course::all();
        return view('lecture.profile', compact('course'));
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
