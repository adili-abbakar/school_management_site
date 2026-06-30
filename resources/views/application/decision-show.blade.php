@extends('layouts.app')

@section('title', 'Apply For Admission')

@section('page-content')
    <main class="flex-1 flex flex-col overflow-hidden">
        <x-dashboard-header />
        <x-loader-component />

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
                            @switch($app->status)
                                @case('pending')
                                    <span class="status-pending text-xs font-bold px-3 py-1 rounded">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                @break

                                @case('processing')
                                    <span class="status-processing text-xs font-bold px-3 py-1 rounded">
                                        <i class="fas fa-spinner mr-1"></i>Processing
                                    </span>
                                @break

                                @case('approved')
                                    <span class="status-approved text-xs font-bold px-3 py-1 rounded">
                                        <i class="fas fa-check-circle mr-1"></i>Approved
                                    </span>
                                @break

                                @case('awaiting_guardian_response')
                                    <span class="status-awaiting-guardian-response text-xs font-bold px-3 py-1 rounded">
                                        <i class="fas fa-user-clock mr-1"></i>Awaiting Guardian Response
                                    </span>
                                @break

                                @case('completed')
                                    <span class="status-approved text-xs font-bold px-3 py-1 rounded">
                                        <i class="fas fa-clipboard-check mr-1"></i>Completed
                                    </span>
                                @break

                                @case('rejected')
                                    <span class="status-rejected text-xs font-bold px-3 py-1 rounded">
                                        <i class="fas fa-minus-circle mr-1"></i>Rejected
                                    </span>
                                @break

                                @case('withdrawn')
                                    <span class="status-withdrawn text-xs font-bold px-3 py-1 rounded">
                                        <i class="fas fa-times-circle mr-1"></i>Withdrawn
                                    </span>
                                @break

                                @default
                                    <span class="status-withdrawn text-xs font-bold px-3 py-1 rounded">
                                        <i class="fas fa-question-circle mr-1"></i>Unknown
                                    </span>
                            @endswitch
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
                <form action="{{ route('applications.decision.make', $app) }}" method="POST" class="form">
                    @csrf
                    @method('PUT')

                    <!-- Requested Programs Section -->
                    <div class="mb-6">
                        <h3 class="text-base font-bold text-slate-900 mb-4">
                            <i class="fas fa-list text-accent mr-2"></i>Requested Programs
                        </h3>

                        <!-- Program Card  -->
                        @forelse ($app->programs as $program)
                            <div
                                class=" dependent-select-group bg-white border border-slate-200 rounded-lg p-5 mb-4 shadow-sm">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4  ">
                                    <div>
                                        <label class="text-xs font-semibold text-slate-600 mb-1 block">Program Name</label>
                                        <p class="text-sm font-bold text-slate-900 bg-slate-50 px-3 py-2 rounded">
                                            {{ $program->program->name }}
                                        </p>
                                        <input type="hidden" name="programs[{{ $loop->index }}][program_id]" data-field="program_id"
                                            value="{{ $program->program->id }}">
                                        <input type="hidden" name="programs[{{ $loop->index }}][id]" data-field="id"
                                            value="{{ $program->id }}">
                                    </div>
                                    <div>
                                        <label class="text-xs font-semibold text-slate-600 mb-1 block">Requested
                                            Class</label>
                                        <p class="text-sm font-bold text-slate-900 bg-slate-50 px-3 py-2 rounded">
                                            {{ $program->requestedClass->name }}
                                        </p>
                                        <input type="hidden" name="programs[{{ $loop->index }}][requested_class_id]"
                                            data-field="requested_class_id" value="{{ $program->requested_class_id }}">
                                    </div>
                                    <div>
                                        <label class="text-xs font-semibold text-slate-600 mb-1 block">Approved
                                            Class</label>
                                        <select data-target="stream_id" data-route="/classes/{id}/arms"
                                            name="programs[{{ $loop->index }}][approved_class_id]"
                                            data-field="approved_class_id"
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
                                        <span class="text-red-600 text-[10px] error-message" data-field="approved_class_id"
                                            data-name="programs.{{ $loop->index }}.approved_class_id"></span>
                                    </div>
                                    <div>
                                        <label class="text-xs font-semibold text-slate-600 mb-1 block">Approved Stream Arm
                                            (for
                                            senior secondary classes only)
                                        </label>
                                        <select name="programs[{{ $loop->index }}][approved_stream]"
                                            data-field="approved_stream"
                                            class="stream_id w-full text-xs px-3 py-2 border border-slate-300 rounded font-medium text-slate-900">
                                            <option value="" selected>
                                                -- Select class first--
                                            </option>
                                        </select>
                                        <span class="text-red-600 text-[10px] error-message" data-field="approved_stream"
                                            data-name="programs.{{ $loop->index }}.approved_stream"></span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs font-semibold text-slate-600 mb-1 block">Program
                                            Status</label>
                                        <select name="programs[{{ $loop->index }}][status]"
                                            class="w-full text-xs px-3 py-2 border border-slate-300 rounded font-medium text-slate-900">
                                            <option value="">
                                                -- Select Status --
                                            </option>
                                            <option value="approved"> Approve </option>
                                            <option value="awaiting_guardian_response">Awaiting guardian response</option>
                                            <option value="rejected"> Reject </option>
                                        </select>
                                        <span class="text-red-600 text-[10px] error-message" data-field="status"
                                            data-name="programs.{{ $loop->index }}.status"></span>
                                    </div>
                                    <div>
                                        <label class="text-xs font-semibold text-slate-600 mb-1 block">Remarks
                                            (Optional)
                                        </label>
                                        <textarea class="w-full text-xs px-3 py-2 border border-slate-300 rounded" rows="2"
                                            name="programs[{{ $loop->index }}][remarks]" placeholder="Add remarks for this program..."></textarea>
                                        <span class="text-red-600 text-[10px] error-message" data-field="remarks"
                                            data-name="programs.{{ $loop->index }}.remarks"></span>
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
                                <select name="status"
                                    class="w-full text-xs px-3 py-2 border border-slate-300 rounded font-medium text-slate-900">
                                    <option value="">
                                        -- Select Status --
                                    </option>

                                    <option value="approved">Approve</option>
                                    <option value="awaiting_guardian_response">Awaiting guardian response</option>
                                    <option value="rejected">Reject</option>
                                </select>
                                <span class="text-red-600 text-[10px] error-message" data-name="status"></span>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-slate-600 mb-1 block">Admission Date</label>
                                <input type="date" value="{{ now()->format('Y-m-d') }}" name="decision_date"
                                    class="w-full text-xs px-3 py-2 border border-slate-300 rounded font-medium" />
                                <span class="text-red-600 text-[10px] error-message" data-name="decision_date"></span>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-slate-600 mb-1 block">Decision By</label>
                                <p class="text-sm font-bold text-slate-900 bg-slate-50 px-3 py-2 rounded">
                                    {{ auth()->user()->full_name }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-slate-600 mb-1 block">General Admission
                                Remarks</label>
                            <textarea class="w-full text-xs px-3 py-2 border border-slate-300 rounded" rows="3" name="remarks"
                                placeholder="Add general remarks about this application..."></textarea>
                            <span class="text-red-600 text-[10px] error-message" data-name="remarks"></span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3">
                        <button
                            class="px-4 py-2 bg-slate-100 text-slate-700 rounded font-medium text-xs hover:bg-slate-200 transition">
                            <i class="fas fa-save mr-2"></i>Save Draft
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded font-medium text-xs hover:bg-blue-600 transition">
                            <i class="fas fa-check mr-2"></i>Save Decision
                        </button>
                        <button
                            class="px-4 py-2 bg-green-500 text-white rounded font-medium text-xs hover:bg-green-600 transition">
                            <i class="fas fa-thumbs-up mr-2"></i>Approve
                        </button>
                        <button
                            class="px-4 py-2 bg-red-500 text-white rounded font-medium text-xs hover:bg-red-600 transition">
                            <i class="fas fa-ban mr-2"></i>Reject
                        </button>
                        <button onclick="window.history.back()"
                            class="px-4 py-2 bg-slate-200 text-slate-600 rounded font-medium text-xs hover:bg-slate-300 transition ml-auto">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>

        <script src="{{ asset('js/auto-select.js') }}"></script>
        <script src="{{ asset('js/formSubmitter.js') }}"></script>
    </main>
@endsection
