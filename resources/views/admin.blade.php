@extends('layouts.app')

@section('header')
Profile Management
@endsection

@section('side')
<li class="nav-item">
    <a class="nav-link" href="/dashboard">Profile</a>
</li>
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
<li class="nav-item">
    <a class="nav-link" href="/admin/report">Reports</a>
</li>
@endsection


@section('content')
<div class="container">
    <h4 class="mb-4">My Profile</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">New Password <small>(leave blank if not changing)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
