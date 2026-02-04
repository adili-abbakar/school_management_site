@extends('layouts.app')

@section('title', 'Create Acadeimc Sessions')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header />
        <div class="flex-1 overflow-y-auto">
            <div class="p-4 md:p-8">
                <x-loader-component />

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                    <div>
                        <h1 class="text-xl font-extrabold text-primary">Create New Session</h1>
                        <p class="text-slate-500 text-xs">Add a new academic session to the school database.</p>
                    </div>
                    <x-buttons.gray-back-to-list />
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <i class="fas fa-plus-circle text-accent text-lg"></i>
                        <h2 class="text-primary font-semibold">New Academic Session</h2>
                    </div>

                    <form id="form" class="space-y-6" action="{{ route('sessions.store') }}" method="POST">
                        @csrf

                        <!-- Session Basic Information -->
                        <x-sessions.form-fields />

                        <!-- Divider -->
                        <div class="border-t border-slate-200 pt-4"></div>

                        <!-- Terms -->
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-sm font-semibold text-primary">Terms</h3>
                            </div>

                            <!-- Terms Container -->
                            <div id="termsContainer" class="space-y-4">
                                <div class="term-block bg-slate-50 p-4 rounded border border-slate-200">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Term Name</label>
                                            <input type="text" name="first_term_name" value="First Term"
                                                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white cursor-not-allowed"
                                                disabled>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Start
                                                Date</label>
                                            <input type="date" name="first_term_start_date"
                                                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                                            <span class="text-red-600 text-[10px] error-message"
                                                data-name="first_term_start_date"></span>

                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">End Date</label>
                                            <input type="date" name="first_term_end_date"
                                                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                                            <span class="text-red-600 text-[10px] error-message"
                                                data-name="first_term_end_date"></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="term-block bg-red-50 p-4 rounded border border-slate-200">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Term Name</label>
                                            <input type="text" name="second_term_name" value="Second Term"
                                                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white cursor-not-allowed"
                                                disabled>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Start
                                                Date</label>
                                            <input type="date" name="second_term_start_date"
                                                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                                            <span class="text-red-600 text-[10px] error-message"
                                                data-name="second_term_start_date"></span>

                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">End Date</label>
                                            <input type="date" name="second_term_end_date"
                                                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                                            <span class="text-red-600 text-[10px] error-message"
                                                data-name="second_term_end_date"></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="term-block bg-blue-50 p-4 rounded border border-slate-200">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Term Name</label>
                                            <input type="text" name="third_term_name" value="Third Term"
                                                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white cursor-not-allowed"
                                                disabled>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Start
                                                Date</label>
                                            <input type="date" name="third_term_start_date"
                                                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                                            <span class="text-red-600 text-[10px] error-message"
                                                data-name="third_term_start_date"></span>

                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">End Date</label>
                                            <input type="date" name="third_term_end_date"
                                                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                                            <span class="text-red-600 text-[10px] error-message"
                                                data-name="third_term_end_date"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-slate-200 pt-4"></div>

                        <!-- Form Actions -->
                        <div class="flex gap-3 justify-end">
                            <x-buttons.transparent-cancel />
                            <x-buttons.light-blue-submit />

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('/js/formSubmitter.js') }}"></script>

@endsection
