@extends('lecture.admin')

@section('header')
Report
@endsection

@section('content')
<div class="container">
    <h4 class="mb-4">Student Attendance Report</h4>
    <div class="mb-3">
    <a href="{{ route('attendance.report.pdf') }}" class="btn btn-danger">Download PDF</a>
</div>


    <table class="table table-bordered table-striped table-sm">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Total Days</th>
                <th>Days Present</th>
                <th>Attendance %</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->totalDays }}</td>
                    <td>{{ $student->presentDays }}</td>
                    <td>{{ $student->percentage }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No student records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
