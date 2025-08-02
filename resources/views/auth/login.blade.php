<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 15px;">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <h2 class="text-center mb-4">Log in</h2>

            <!-- Email Address -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label text-sm text-gray-600">{{ __('Remember me') }}</label>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between align-items-center">
                @if (Route::has('password.request'))
                    <a class="text-decoration-none text-secondary" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <x-primary-button class="btn btn-danger ms-4">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
