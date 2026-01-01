@extends('layouts.guest.auth')

@section('title', 'Reset Password')

@section('page-content')

  <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center p-3 bg-white text-blue-900 rounded-2xl mb-4 shadow-xl shadow-gray-200/50 border border-gray-100">
                <i class="fas fa-shield-halved text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-blue-900 tracking-tight">Set New Password</h1>
            <p class="text-gray-500 mt-1">Please create a strong password for your account.</p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100">
            <form action="login.html" class="space-y-5">
                <div>
                    <label class="form-label">New Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        <input type="password" class="form-input pl-10" placeholder="••••••••" required>
                    </div>
                    <div class="mt-2 flex gap-1">
                        <div class="h-1 flex-1 bg-green-500 rounded-full"></div>
                        <div class="h-1 flex-1 bg-green-500 rounded-full"></div>
                        <div class="h-1 flex-1 bg-gray-200 rounded-full"></div>
                        <div class="h-1 flex-1 bg-gray-200 rounded-full"></div>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1">Password strength: Medium</p>
                </div>

                <div>
                    <label class="form-label">Confirm New Password</label>
                    <div class="relative">
                        <i class="fas fa-check-circle absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        <input type="password" class="form-input pl-10" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-blue-800 shadow-lg shadow-blue-900/20 transition-all">
                    UPDATE PASSWORD
                </button>
            </form>
        </div>
    </div>
@endsection 