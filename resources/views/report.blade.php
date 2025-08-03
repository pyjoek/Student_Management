@extends('layouts.app')

@section('side')
<li class="nav-item">
    <a class="nav-link" href="/profile">Profile</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/report">Reports</a>
</li>

@endsection

@section('content')
<div class="container">
    <h4 class="mb-4">Attendance Report</h4>

    <div class="mb-3">
        <strong>Total Days Present:</strong> {{ $totalPresent }} <br>
        <strong>Attendance Percentage:</strong> {{ $attendancePercentage }}%
    </div>

    <table class="table table-bordered table-sm">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $index => $attendance)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                    <td>
                        <span class="badge bg-success">{{ ucfirst($attendance->status) }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No attendance records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
