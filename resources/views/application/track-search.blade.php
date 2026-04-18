@extends('layouts.guest.app')

@section('title', 'Track Admission Application')

@section('page-content')
    <main class="flex-grow">
        <x-loader-component />

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

                <div id="globalError" class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out mb-4">
                    <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                        <span class="text-sm font-medium"></span>
                    </div>
                </div>

                <div class="bg-white p-8 md:p-10 rounded-xl border border-gray-200 shadow-sm" data-aos="fade-up">
                    <h2 class="section-title">Application Lookup</h2>

                    <form method="POST" action="{{ route('applications.track.search') }}" class="form space-y-6">
                        @csrf

                        <div>
                            <label for="application_number" class="form-label">
                                Application Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="application_number" name="application_number"
                                value="{{ old('application_number') }}" class="form-input"
                                placeholder="e.g. APP-2025-2026-000001">
                            <span class="text-red-600 text-[10px] error-message" data-name="application_number"></span>

                        </div>

                        <div>
                            <label for="guardian_email" class="form-label">
                                Guardian Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="guardian_email" name="guardian_email"
                                value="{{ old('guardian_email') }}" class="form-input"
                                placeholder="Enter the email used during application">
                            <span class="text-red-600 text-[10px] error-message" data-name="guardian_email"></span>

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
    <script src="{{ asset('/js/formSubmitter.js') }}"></script>
@endsection
