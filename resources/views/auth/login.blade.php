@extends('layouts.guest.auth')

@section('title', 'Login')

@section('page-content')

    <x-loader-component />

    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center p-3 bg-blue-900 text-white rounded-2xl mb-4 shadow-xl shadow-blue-900/20">
                <i class="fas fa-graduation-cap text-3xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-blue-900 tracking-tight">Welcome Back</h1>
            <p class="text-gray-500 mt-1">Sign in to your school management portal</p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100">
            <form action="{{ route('login.attempt') }}" id="loginForm" class="space-y-5" method="post">
                @csrf

                <!-- Global error placeholder -->
                <div id="globalError" class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out mb-4">
                    <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                        <span class="text-sm font-medium"></span>
                    </div>
                </div>


                <!-- Email field -->
                <div>
                    <label class="form-label">Email Address or Username</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        <input type="text" name="email" id="email" class="form-input pl-10"
                            placeholder="e.g. admin@school.com">
                    </div>
                    <span id="emailError" class="text-red-600 text-sm"></span>
                </div>

                <!-- Password field -->
                <div>
                    <label class="form-label mb-0">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        <input type="password" name="password" id="password" class="form-input pl-10"
                            placeholder="••••••••">
                    </div>
                    <span id="passwordError" class="text-red-600 text-sm"></span>
                </div>

                <button type="submit"
                    class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-blue-800 shadow-lg shadow-blue-900/20 transition-all flex items-center justify-center gap-2">
                    SIGN IN <i class="fas fa-arrow-right text-[10px]"></i>
                </button>
            </form>



            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-500">
                    Don't have an account?
                    <a href="{{ route('admission.apply') }}" class="font-bold text-blue-600 hover:underline ml-1">Apply for
                        Admission</a>
                </p>
            </div>
        </div>


        <div class="mt-8 text-center flex items-center justify-center gap-4">
            <a href="index.html" class="text-xs text-gray-400 hover:text-blue-900 font-medium transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Back to Website
            </a>
            <span class="text-gray-200">|</span>
            <a href="#" class="text-xs text-gray-400 hover:text-blue-900 font-medium transition-colors">Support</a>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            showLoader();

            let form = this;
            let formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    let globalError = document.getElementById('globalError');
                    let globalErrorText = globalError.querySelector('span');
                    let emailInput = document.getElementById('email');
                    let passwordInput = document.getElementById('password');
                    let emailError = document.getElementById('emailError');
                    let passwordError = document.getElementById('passwordError');

                    // Reset field errors
                    emailError.innerText = '';
                    passwordError.innerText = '';
                    emailInput.classList.remove('border-red-600');
                    passwordInput.classList.remove('border-red-600');

                    // Collapse global error by default
                    globalError.style.maxHeight = '0px';

                    globalErrorText.innerText = '';

                    if (data.status === 'success') {
                        window.location.assign(data.redirect);
                    } else if (data.type === 'validation') {
                        hideLoader()
                        if (data.errors.email) {
                            emailError.innerText = data.errors.email[0];
                            emailInput.classList.add('border-red-600');
                        }
                        if (data.errors.password) {
                            passwordError.innerText = data.errors.password[0];
                            passwordInput.classList.add('border-red-600');
                        }
                    } else if (data.type === 'auth') {
                        hideLoader()
                        // Expand smoothly
                        globalErrorText.innerText = data.message;
                        globalError.style.maxHeight = '200px'; // enough to fit content


                        // Collapse back after 3s
                        setTimeout(() => {
                            globalError.style.maxHeight = '0px';
                        }, 3000);
                    }
                })

                .catch(error => {
                    hideLoader();
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
