@extends('layouts.app')

@section('side')
<li class="nav-item">
    <a class="nav-link" href="/user">Add User</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('new.course') }}">Add Course</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/attendance">Attendance</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="/academy">Academy</a>
</li>
@endsection

@section('content')

@endsection