@extends('layouts.app')

@section('title', 'Apply For Admission')

@section('page-content')
    <main class="flex-1 flex flex-col overflow-hidden">
        <x-dashboard-header />

        <div class="flex-1 overflow-y-auto p-6">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-6">
                    <x-buttons.blue-back-link>Application(s)</x-buttons.blue-back-link>
                    <h1 class="text-xl font-bold text-slate-800">
                        Admission Decision
                    </h1>
                    <p class="text-xs text-slate-500">
                        Review the application and make the final admission
                        decision.
                    </p>
                </div>

                <!-- Summary Card -->
                <div class="bg-white border border-slate-200 rounded-lg p-5 mb-6 shadow-sm">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-xs text-slate-500 font-semibold mb-1">
                                Application #
                            </p>
                            <p class="text-sm font-bold text-slate-900">
                                {{ $app->application_number }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold mb-1">
                                Applicant Name
                            </p>
                            <p class="text-sm font-bold text-slate-900">
                                {{ $app->student_name }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold mb-1">
                                Status
                            </p>
                            <span
                                class="inline-block bg-amber-100 text-amber-800 px-2 py-1 rounded text-xs font-semibold">{{ ucwords($app->status) }}</span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold mb-1">
                                Applied Date
                            </p>
                            <p class="text-sm font-bold text-slate-900">
                                {{ $app->applied_on }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold mb-1">
                                Requested stream (for senior secondary classes only)
                            </p>
                            <p class="text-sm font-bold text-slate-900">
                                {{ ucwords($app->stream ?? 'No provided') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Requested Programs Section -->
                <div class="mb-6">
                    <h3 class="text-base font-bold text-slate-900 mb-4">
                        <i class="fas fa-list text-accent mr-2"></i>Requested Programs
                    </h3>

                    <!-- Program Card 1 -->
                    @forelse ($app->programs as $program)
                        <div class=" dependent-select-group bg-white border border-slate-200 rounded-lg p-5 mb-4 shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4  ">
                                <div>
                                    <label class="text-xs font-semibold text-slate-600 mb-1 block">Program Name</label>
                                    <p class="text-sm font-bold text-slate-900 bg-slate-50 px-3 py-2 rounded">
                                        {{ $program->program->name }}
                                    </p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-slate-600 mb-1 block">Requested Class</label>
                                    <p class="text-sm font-bold text-slate-900 bg-slate-50 px-3 py-2 rounded">
                                        {{ $program->requestedClass->name }}
                                    </p>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-slate-600 mb-1 block">Approved Class</label>
                                    <select data-target="stream_id" data-route="/classes/{id}/arms"
                                        class="class_id w-full text-xs px-3 py-2 border border-slate-300 rounded font-medium text-slate-900">
                                        <option value="">
                                            -- Select Approved Class --
                                        </option>
                                        @forelse ($program->program->classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @empty
                                            <option value="" disabled>No class found</option>
                                        @endforelse

                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-slate-600 mb-1 block">Approved Stream Arm (for
                                        senior secondary classes only)</label>
                                    <select
                                        class="stream_id w-full text-xs px-3 py-2 border border-slate-300 rounded font-medium text-slate-900">
                                        <option value="" selected>
                                            -- Select class first--
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs font-semibold text-slate-600 mb-1 block">Program Status</label>
                                    <select
                                        class="w-full text-xs px-3 py-2 border border-slate-300 rounded font-medium text-slate-900">
                                        <option value="">
                                            -- Select Status --
                                        </option>
                                        <option value="pending" selected>
                                            Pending
                                        </option>
                                        <option value="approved">
                                            Approved
                                        </option>
                                        <option value="rejected">
                                            Rejected
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs font-semibold text-slate-600 mb-1 block">Remarks
                                        (Optional)
                                    </label>
                                    <textarea class="w-full text-xs px-3 py-2 border border-slate-300 rounded" rows="2"
                                        placeholder="Add remarks for this program..."></textarea>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border border-slate-200 rounded-lg p-5 mb-4 shadow-sm">
                            <p class="w-full text-center">No programs found!</p>
                        </div>
                    @endforelse

                </div>

                <!-- Overall Admission Decision -->
                <div class="bg-white border border-slate-200 rounded-lg p-5 mb-6 shadow-sm">
                    <h3 class="text-base font-bold text-slate-900 mb-4">
                        <i class="fas fa-check-circle text-accent mr-2"></i>Overall Admission Decision
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="text-xs font-semibold text-slate-600 mb-1 block">Overall Application
                                Status</label>
                            <select
                                class="w-full text-xs px-3 py-2 border border-slate-300 rounded font-medium text-slate-900">
                                <option value="">
                                    -- Select Status --
                                </option>
                                <option value="pending" selected>
                                    Pending
                                </option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-slate-600 mb-1 block">Admission Date</label>
                            <input type="date"  value="{{ now()->format('Y-m-d') }}"
                                class="w-full text-xs px-3 py-2 border border-slate-300 rounded font-medium" />
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-slate-600 mb-1 block">Decision By</label>
                            <p class="text-sm font-bold text-slate-900 bg-slate-50 px-3 py-2 rounded">
                                {{ auth()->user()->full_name }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-slate-600 mb-1 block">General Admission Remarks</label>
                        <textarea class="w-full text-xs px-3 py-2 border border-slate-300 rounded" rows="3"
                            placeholder="Add general remarks about this application..."></textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3">
                    <button
                        class="px-4 py-2 bg-slate-100 text-slate-700 rounded font-medium text-xs hover:bg-slate-200 transition">
                        <i class="fas fa-save mr-2"></i>Save Draft
                    </button>
                    <button
                        class="px-4 py-2 bg-blue-500 text-white rounded font-medium text-xs hover:bg-blue-600 transition">
                        <i class="fas fa-check mr-2"></i>Save Decision
                    </button>
                    <button
                        class="px-4 py-2 bg-green-500 text-white rounded font-medium text-xs hover:bg-green-600 transition">
                        <i class="fas fa-thumbs-up mr-2"></i>Approve
                    </button>
                    <button class="px-4 py-2 bg-red-500 text-white rounded font-medium text-xs hover:bg-red-600 transition">
                        <i class="fas fa-ban mr-2"></i>Reject
                    </button>
                    <button onclick="window.history.back()"
                        class="px-4 py-2 bg-slate-200 text-slate-600 rounded font-medium text-xs hover:bg-slate-300 transition ml-auto">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                </div>
            </div>
        </div>
        </div>

        <script src="{{ asset('js/auto-select.js') }}"></script>
    </main>
@endsection
