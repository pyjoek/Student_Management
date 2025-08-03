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
    <div class="form-selectin mb-2">
        <button id="toggle-btn" class="btn btn-primary" onclick="project()">Add New Lecture</button>
        <button id="toggle-btn" class="btn btn-primary" onclick="customer()">Add New Student</button>
    </div>
</center>

<center>
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
            <div class="card shadow-sm p-3" style="max-width: 400px; width: 100%; border-radius: 10px;">
                <form method="POST" action="{{ route('new.marks') }}">
                    @csrf
                    <h4 class="text-center mb-3">Mark Students</h4>

                    <table>
                        <th>Course Name</th>
                        <th>Student Name</th>
                        <th>Module</th>
                        @foreach($student as $user)
                            <tr>
                                <td><input type="text" name="student" value="{{$user->name}}"></td>
                                <td><input type="text" name="course" value="{{$user->course->course}}"></td>
                                <td>
                                    <select name="module" id="">
                                        @foreach($user->course->academy as $module)
                                            <option value="{{$module->module}}">{{$module->module}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="marks" placeholder="Marks"></td>
                                <td>
                                    <input type="submit" value="Mark">
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </form>
            </div>
        </div>
    </div>
</center>

@endsection