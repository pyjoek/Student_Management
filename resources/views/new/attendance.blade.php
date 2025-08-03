@extends('admin')

@section('header')
Attendance
@endsection

@section('content')
<div class="container">
    @if(!empty($lowAttendanceStudents))
        <div class="alert alert-danger">
            <strong>Alert:</strong> The following students have less than 50% overall attendance:
            <ul class="mb-0">
                @foreach($lowAttendanceStudents as $student)
                    <li>{{ $student['name'] }} — {{ $student['percentage'] }}%</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- List of attendance dates --}}
    <h5>Select a Date</h5>
    <div class="d-flex overflow-auto gap-2 mb-4" style="white-space: nowrap;">
    @foreach($dates as $date)
        <a href="{{ route('attendance.show', ['date' => $date]) }}" 
           class="btn btn-outline-primary flex-shrink-0">
            {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
        </a>
    @endforeach
</div>


    {{-- Attendance details for selected date --}}
    @if(isset($attendanceData))
        <h5>Attendance for {{ \Carbon\Carbon::parse($selectedDate)->format('F j, Y') }}</h5>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceData as $index => $record)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $record->student->name }}</td>
                        <td>{{ ucfirst($record->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
