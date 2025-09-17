@extends('student.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <h4>Welcome, {{ auth()->user()->name }}</h4>

    <form action="/attendanced" method="POST">
        @csrf
        <input type="hidden" name="date" value="{{ \Carbon\Carbon::now()->toDateString() }}">

        @if($alreadyMarked)
            <div class="alert alert-success p-2">
                You've already marked your attendance for today.
            </div>
            <button type="submit" class="btn btn-success" disabled>Attendance Already Marked</button>
        @else
            <button type="submit" class="btn btn-primary">Mark Attendance for Today</button>
        @endif
    </form>

    <div>
        <h5>Your Attendance Count: {{ $attendanceCount }}</h5>
    </div>
</div>
@endsection
