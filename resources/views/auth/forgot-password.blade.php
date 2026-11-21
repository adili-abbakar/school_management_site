@extends('layouts.guest.auth')

@section('title', 'Forgot Password')

@section('page-content')
    <x-loader-component />

    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div
                class="inline-flex items-center justify-center p-3 bg-white text-blue-900 rounded-2xl mb-4 shadow-xl shadow-gray-200/50 border border-gray-100">
                <i class="fas fa-key text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-blue-900 tracking-tight">Reset Password</h1>
            <p class="text-gray-500 mt-1 max-w-70 mx-auto">Enter your email and we'll send you instructions to reset
                your password.</p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100">
            <form action="{{ route('password.email') }}" id="authForm" class="space-y-6" method="post">
                @csrf

                <div id="globalError" class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out mb-4">
                    <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                        <span class="text-sm font-medium"></span>
                    </div>
                </div>


                <div>
                    <label class="form-label">Email Address or Username</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        <input type="text" name="email" id="email" class="form-input pl-8!"
                            placeholder="e.g. admin@school.com">
                    </div>
                    <span id="emailError" class="text-red-600 text-sm"></span>
                </div>

                <button type="submit"
                    class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-blue-800 shadow-lg shadow-blue-900/20 transition-all">
                    SEND INSTRUCTIONS
                </button>

                <a href="{{ route('login') }}"
                    class="block text-center text-xs font-bold text-gray-400 hover:text-blue-900 uppercase tracking-widest transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Login
                </a>

            </form>
        </div>
    </div>

    <script src="{{ asset('js/authFormSubmitter.js') }}"></script>
@endsection
