@extends('layouts.blade')

@section('side')
<li class="nav-item">
    <a class="nav-link" href="{{ route('new.student') }}">Attendance</a>
</li>
@endsection

@section('content')
<div class="staff">
            <form method="POST" action="{{ route('newStaff') }}">
                @csrf
                <center>
                    <div>
                        <input type="text" name="name" placeholder="Full Name">
                        <input type="text" name="phone" placeholder="Phone Number">
                        <div>
                            <select name="department" required>
                                <option value="">Select Department</option>
                                @foreach ($depart as $part)
                                <option value="{{ $part->id }}">{{$part->department}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="text" name="resign" placeholder="resign">
                        <input type="submit" value="Register">
                    </div>
                </center>
            </form>
        </div>
@endsection