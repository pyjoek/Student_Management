@extends('admin')

@section('header')
Users
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
        <button id="toggle-btn" class="btn btn-primary" onclick="project()">Add New Project</button>
        <button id="toggle-btn" class="btn btn-primary" onclick="customer()">Add New Customer</button>
    </div>
</center>

<div class="user">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm p-3" style="max-width: 400px; width: 100%; border-radius: 10px;">
            <form method="POST" action="{{ route('register') }}">
                @csrf
    
                <h4 class="text-center mb-3">Add New User</h4>
    
                <!-- Name -->
                <div class="mb-2">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="form-control form-control-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="text-danger mt-1" />
                </div>
    
                <!-- Email Address -->
                <div class="mb-2">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control form-control-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
                </div>
    
                <!-- Role Selection -->
                <div class="mb-2">
                    <x-input-label for="role" :value="__('Role')" />
                    <select id="role" name="role" class="form-select form-select-sm" required>
                        <option value="">Select Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Lecture</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Student</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="text-danger mt-1" />
                </div>
    
                <!-- Password -->
                <div class="mb-2">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="form-control form-control-sm" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
                </div>
    
                <!-- Confirm Password -->
                <div class="mb-3">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="form-control form-control-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-1" />
                </div>
    
                <!-- Submit Button -->
                <div class="d-flex justify-content-between align-items-center">
                    <a class="text-decoration-none text-secondary small" href="{{ route('login') }}">
                        Already registered?
                    </a>
                    <x-primary-button class="btn btn-danger btn-sm ms-2">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="all">
    <table class="">
        <th>Name</th>
        <th>Email</th>
        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
        </tr>
        @endforeach
    </table>
</div>

@endsection