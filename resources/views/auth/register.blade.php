<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 15px;">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <h2 class="text-center mb-4">Register</h2>

            <!-- Name -->
            <div class="mb-3">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="text-danger mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
            </div>

            <!-- Role Selection -->
            <div class="mb-3">
                <label for="role" class="form-label">Register as</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="">Select Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Lecture</option>
                    <!-- <option value="manager" {{ old('role') == 'lecture' ? 'selected' : '' }}></option> -->
                    <!-- <option value="staff" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option> -->
                </select>
                <x-input-error :messages="$errors->get('role')" class="text-danger mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-between align-items-center">
                <a class="text-decoration-none text-secondary" href="{{ route('login') }}">
                    Already registered?
                </a>
                <x-primary-button class="btn btn-danger ms-4 w-auto">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
