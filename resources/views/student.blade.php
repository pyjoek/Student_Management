@extends('layouts.app')

@section('side')
<li class="nav-item">
    <a class="nav-link" href="/profile">Profile</a>
</li>

@endsection

@section('content')
<div class="container">
    <h4>Welcome, {{ auth()->user()->name }}</h4>

    <div class="mb-3">
        <strong>Attendance Days:</strong> {{ $attendanceCount }}
    </div>

    <form action="attendanced" method="POST">
        @csrf
        <input type="hidden" name="date" value="{{ \Carbon\Carbon::now()->toDateString() }}">

        @if($alreadyMarked)
            <div class="alert alert-success p-2">
                You've already marked your attendance for today.
            </div>
            <button type="submit" class="btn btn-success" disabled>Already Marked</button>
        @else
            <button type="submit" class="btn btn-primary">Mark Attendance for Today</button>
        @endif
    </form>
</div>
@endsection
