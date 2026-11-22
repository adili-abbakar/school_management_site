@extends('layouts.guest.auth')

@section('title', 'Reset Password')

@section('page-content')
    <x-loader-component />

    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center p-3 bg-white text-blue-900 rounded-2xl mb-4 shadow-xl shadow-gray-200/50 border border-gray-100">
                <i class="fas fa-lock text-2xl"></i>
            </div>

            <h1 class="text-2xl font-bold text-blue-900 tracking-tight">
                Set New Password
            </h1>

            <p class="text-gray-500 mt-1">
                Please create a strong password for your account.
            </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100">

            <form action="{{ route('password.update') }}" id="authForm" class="form space-y-5" method="POST">
                @csrf

                {{-- Required for password reset verification --}}
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="token" value="{{ $token }}">


                <span id="emailError" class="text-red-600 text-sm"></span>
                <span id="tokenError" class="text-red-600 text-sm"></span>
                <div id="globalError" class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out mb-4">
                    <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <i class="fas fa-exclamation-circle text-red-600"></i>

                        <span class="text-sm font-medium"></span>
                    </div>
                </div>

                {{-- New Password --}}
                <div>
                    <label for="password" class="form-label">
                        New Password
                    </label>

                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>

                        <input type="password" name="password" id="password" class="form-input pl-10!"
                            placeholder="••••••••" autocomplete="new-password">
                    </div>

                    <span id="passwordError" class="text-red-600 text-sm"></span>

                    {{-- Password strength --}}
                    <div class="mt-2 flex gap-1">
                        <div id="strengthWeak" class="h-1 flex-1 bg-gray-200 rounded-full transition-colors"></div>

                        <div id="strengthMedium" class="h-1 flex-1 bg-gray-200 rounded-full transition-colors"></div>

                        <div id="strengthStrong" class="h-1 flex-1 bg-gray-200 rounded-full transition-colors"></div>
                    </div>

                    <p id="passwordStrength" class="text-[10px] text-gray-400 mt-1">
                        Password strength: —
                    </p>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="form-label">
                        Confirm New Password
                    </label>

                    <div class="relative">
                        <i class="fas fa-check-circle absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>

                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-input pl-10!" placeholder="••••••••" autocomplete="new-password">
                    </div>

                    <span id="password_confirmationError" class="text-red-600 text-sm"></span>
                </div>

                <button type="submit"
                    class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-blue-800 shadow-lg shadow-blue-900/20 transition-all">
                    UPDATE PASSWORD
                </button>

            </form>
        </div>
    </div>

    <script src="{{ asset('js/authFormSubmitter.js') }}"></script>

    <script>
        const passwordInput = document.getElementById('password');
        const strengthText = document.getElementById('passwordStrength');

        const strengthWeak = document.getElementById('strengthWeak');
        const strengthMedium = document.getElementById('strengthMedium');
        const strengthStrong = document.getElementById('strengthStrong');

        passwordInput.addEventListener('input', function() {
            const password = this.value;

            strengthWeak.className =
                'h-1 flex-1 bg-gray-200 rounded-full transition-colors';

            strengthMedium.className =
                'h-1 flex-1 bg-gray-200 rounded-full transition-colors';

            strengthStrong.className =
                'h-1 flex-1 bg-gray-200 rounded-full transition-colors';

            if (password.length === 0) {
                strengthText.textContent = 'Password strength: —';
                return;
            }

            let score = 0;

            if (password.length >= 8) {
                score++;
            }

            if (/[a-z]/.test(password)) {
                score++;
            }

            if (/[A-Z]/.test(password)) {
                score++;
            }

            if (/[0-9]/.test(password)) {
                score++;
            }

            if (/[^A-Za-z0-9]/.test(password)) {
                score++;
            }

            if (score <= 2) {
                strengthWeak.classList.remove('bg-gray-200');
                strengthWeak.classList.add('bg-red-500');

                strengthText.textContent = 'Password strength: Weak';
            } else if (score <= 4) {
                strengthWeak.classList.remove('bg-gray-200');
                strengthWeak.classList.add('bg-yellow-500');

                strengthMedium.classList.remove('bg-gray-200');
                strengthMedium.classList.add('bg-yellow-500');

                strengthText.textContent = 'Password strength: Medium';
            } else {
                strengthWeak.classList.remove('bg-gray-200');
                strengthWeak.classList.add('bg-green-500');

                strengthMedium.classList.remove('bg-gray-200');
                strengthMedium.classList.add('bg-green-500');

                strengthStrong.classList.remove('bg-gray-200');
                strengthStrong.classList.add('bg-green-500');

                strengthText.textContent = 'Password strength: Strong';
            }
        });
    </script>
@endsection
