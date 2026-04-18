@extends('layouts.guest.app')

@section('title', 'Track Admission Application')

@section('page-content')
    <main class="flex-grow">
        <header class="bg-navy-900 text-white py-12 mb-10">
            <div class="container mx-auto px-4 text-center" data-aos="fade-up">
                <h1 class="text-3xl font-extrabold mb-3 tracking-tight">
                    Track Admission Application
                </h1>
                <p class="text-gray-300 max-w-xl mx-auto text-sm">
                    Enter your application number and guardian email address to check your admission application status.
                </p>
            </div>
        </header>

        <main class="container mx-auto px-4 pb-20">
            <div class="max-w-3xl mx-auto">

                @if (session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl px-4 py-3 text-sm"
                        data-aos="fade-up">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-circle-check mt-0.5"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('failure'))
                    <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-700 rounded-xl px-4 py-3 text-sm"
                        data-aos="fade-up">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-circle-exclamation mt-0.5"></i>
                            <span>{{ session('failure') }}</span>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-700 rounded-xl px-4 py-3 text-sm"
                        data-aos="fade-up">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-circle-exclamation mt-0.5"></i>
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-white p-8 md:p-10 rounded-xl border border-gray-200 shadow-sm" data-aos="fade-up">
                    <h2 class="section-title">Application Lookup</h2>

                    <form method="POST" action="{{ route('applications.track.search') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="application_number" class="form-label">
                                Application Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="application_number" name="application_number"
                                value="{{ old('application_number') }}" class="form-input"
                                placeholder="e.g. APP-2025-2026-000001" required>
                        </div>

                        <div>
                            <label for="guardian_email" class="form-label">
                                Guardian Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="guardian_email" name="guardian_email"
                                value="{{ old('guardian_email') }}" class="form-input"
                                placeholder="Enter the email used during application" required>
                        </div>

                        <div class="pt-2 flex flex-col sm:flex-row gap-3">
                            <button type="submit"
                                class="w-full sm:w-auto px-8 py-3 bg-[#6B8DD6] text-white rounded-lg font-bold text-sm hover:bg-opacity-90 shadow-lg shadow-blue-900/10 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <i class="fas fa-magnifying-glass"></i>
                                Track Application
                            </button>

                            <a href="{{ route('applications.create') }}"
                                class="w-full sm:w-auto px-8 py-3 bg-white text-navy-900 border border-gray-200 rounded-lg font-bold text-sm hover:bg-gray-50 transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-plus"></i>
                                New Application
                            </a>
                        </div>
                    </form>
                </div>

                <div class="mt-8 bg-navy-50 border border-navy-100 rounded-xl p-6 md:p-8" data-aos="fade-up">
                    <h3 class="text-sm font-bold text-navy-900 mb-3 flex items-center gap-2">
                        <i class="fas fa-circle-info text-[#6B8DD6]"></i>
                        Tracking Instructions
                    </h3>

                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-emerald-500 mt-1 text-xs"></i>
                            <span>Use the same guardian email address entered during the application process.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-emerald-500 mt-1 text-xs"></i>
                            <span>Your application number is shown after successful submission.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fas fa-check text-emerald-500 mt-1 text-xs"></i>
                            <span>If your application is still pending, you may also be allowed to withdraw it.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
    </main>
@endsection
