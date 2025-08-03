@extends('admin')

@section('header')
Add New Module
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
    <div class="form-selectin mb-1">
        <button id="toggle-btn" class="btn btn-primary" onclick="project()">Add New Module</button>
        <button id="toggle-btn" class="btn btn-primary" onclick="customer()">Mark Student</button>
    </div>
</center>

    <div class="user">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow-sm p-3" style="max-width: 400px; width: 100%; border-radius: 10px;">
                <form method="POST" action="/academy/module">
                    @csrf
    
                    <h4 class="text-center mb-3">New Module</h4>

                    <!-- Role Selection -->
                    <div class="mb-2">
                        <x-input-label for="role" :value="__('Courses')" />
                        <select id="role" name="course" class="form-select form-select-sm" required>
                            <option value="">Select Role</option>
                            @foreach($course as $cous)
                                <option value="{{$cous->id}}">{{$cous->course}}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="text-danger mt-1" />
                    </div>

                    <!-- Name -->
                    <div class="mb-2">
                        <x-input-label for="name" :value="__('Module Name')" />
                        <x-text-input id="name" class="form-control form-control-sm" type="text" name="module" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="text-danger mt-1" />
                    </div>
    
                    <!-- Submit Button -->
                        <x-primary-button class="btn btn-danger btn-sm ms-2">
                            {{ __('Add') }}
                        </x-primary-button>
                </form>
            </div>
        </div>
    </div>
    
   <div class="all">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm p-3" style="width: 100%; border-radius: 10px;">
            <h4 class="text-center mb-3">Mark Students</h4>

            <form method="POST" action="{{ route('new.marks') }}">
                @csrf
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Course Name</th>
                            <th>Module</th>
                            <th>Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <!-- Student Name -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->name }}" readonly>
                                    <input type="hidden" name="marks[{{ $index }}][student]" value="{{ $user->name }}">
                                </td>

                                <!-- Course Name -->
                                <td>
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->course->course }}" readonly>
                                    <input type="hidden" name="marks[{{ $index }}][course]" value="{{ $user->course->course }}">
                                </td>

                                <!-- Module -->
                                <td>
                                    <select name="marks[{{ $index }}][module]" class="form-select form-select-sm" required>
                                        <option value="">Select Module</option>
                                        @foreach($user->course->academy as $module)
                                            <option value="{{ $module->module }}">{{ $module->module }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <!-- Marks -->
                                <td>
                                    <input type="text" name="marks[{{ $index }}][marks]" class="form-control form-control-sm" placeholder="Enter Marks" required>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-end">
                    <button type="submit" class="btn btn-sm btn-success">Submit All Marks</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection