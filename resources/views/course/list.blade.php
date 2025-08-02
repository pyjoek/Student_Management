@extends('admin')

@section('header')
Attach Lecture to A Course
@endsection

@section('content')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const project = document.querySelector('.user');
        const customer = document.querySelector('.all');
        project.style.display = 'block';
        customer.style.display = 'none';
    })

    function project() {
        const project = document.querySelector('.user');
        const customer = document.querySelector('.all');
        project.style.display = 'block';
        customer.style.display = 'none';
    }

    function customer() {
        const project = document.querySelector('.user');
        const customer = document.querySelector('.all');
        project.style.display = 'none';
        customer.style.display = 'block';
    }
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<center>
    <div class="form-selectin mb-2">
        <button id="toggle-btn" class="btn btn-primary" onclick="project()">Lectures</button>
        <button id="toggle-btn" class="btn btn-primary" onclick="customer()">Students</button>
    </div>
</center>

<center>
    <div class="container mt-4">
            <h4 class="mb-3">Assign Lecture to Course</h4>
    
            <form method="POST" action="{{ route('attach') }}">
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

    <div class="user">
        <table>
            <th>Name</th>
            <th>Email</th>
            @foreach($lecture as $lect)
                <tr>
                    <td>{{$lect->course}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <div class="all">
        <table>

        </table>
    </div>
</center>

@endsection