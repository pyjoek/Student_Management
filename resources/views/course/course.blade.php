@extends('admin')

@section('header')
Course
@endsection

@section('content')
<div class="staff">
    <form method="POST" action="{{ route('new.course') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col-auto mb-3">
                <input type="text" name="course" class="form-control" placeholder="New Course" required>
            </div>
            <div class="col-auto mb-3">
                <input type="submit" class="btn btn-success" value="Add">
            </div>
        </div>
    </form>
</div>


<div class="row justify-content-center mt-3">
    @foreach ($course as $cous)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3 d-flex justify-content-center">
            <button class="btn btn-primary w-100">
                <a href="course/{{$cous->id}}" class="text-white text-decoration-none">{{$cous->course}}</a>
            </button>
        </div>
    @endforeach
</div>

@endsection