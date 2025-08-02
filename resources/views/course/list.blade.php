@extends('layouts.app')

@section('header')
Attach Lecture to A Course
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h4 class="mb-3">Assign Lecture to Course</h4>

    <form method="POST" action="{{ route('new.course') }}">
        @csrf

        <div class="row g-3 align-items-center">
            <!-- Course Name -->
            <div class="col-md-5">
                <label for="course" class="form-label">Course Name</label>
                <input type="text" id="course" name="course" class="form-control" value="{{ $course->course ?? '' }}" required>
            </div>

            <!-- Lecture Selection -->
            <div class="col-md-5">
                <label for="lecture" class="form-label">Select Lecture</label>
                <select name="lecture" id="lecture" class="form-select" required>
                    <option value="">-- Choose Lecture --</option>
                    @foreach($lectures as $lecture)
                        <option value="{{ $lecture->id }}">{{ $lecture->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="col-md-2 d-flex align-items-end">
                <input type="submit" class="btn btn-success w-100" value="Assign">
            </div>
        </div>
    </form>
</div>

@endsection