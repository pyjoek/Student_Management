@extends('student.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Dashboard soon</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
</div>
@endsection
