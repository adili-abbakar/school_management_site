@extends('layouts.app')

@section('title', 'Application Details')

@section('page-content')
    <main class="flex-1 flex flex-col">
        <x-dashboard-header />
        <div class="flex-1 overflow-y-auto p-6">
            <!-- Status Card -->
            <div class="bg-white rounded-lg border border-slate-100 p-5 mb-6">
                <div class="flex flex-col sm:flex-row justify-between items-start mb-2 gap-2">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Application Status</h2>

                    </div>
                    @switch($app->status)
                        @case('pending')
                            <span class="status-pending text-xs font-bold px-3 py-1 rounded"><i
                                    class="fas fa-clock mr-1"></i>Pending</span>
                        @break

                        @case('rejected')
                            <span class="status-rejected text-xs font-bold px-3 py-1 rounded"><i
                                    class="fas fa-minus-circle mr-1"></i>Rejected</span>
                        @break

                        @case('approved')
                            <span class="status-approved text-xs font-bold px-3 py-1 rounded"><i
                                    class="fas fa-check-circle mr-1"></i>Approved</span>
                        @break

                        @case('withdrawn')
                            <span class="status-withdrawn text-xs font-bold px-3 py-1 rounded"><i
                                    class="fas fa-times-circle mr-1"></i>Withdrawn</span>
                        @break
                    @endswitch
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-base font-bold text-slate-900">Application Id: {{ $app->application_number }}</p>
                    <p class="text-xs text-slate-500">Applied {{ $app->created_at->diffForHumans() }}</p>


                    <p class="text-xs text-slate-600">Your application is under review. Expected decision:
                        {{ $app->expected_decision }}</p>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mb-6">
                <div class="bg-white rounded-lg border border-slate-100 p-4">
                    <h3 class="text-xs font-bold text-slate-900 mb-3"><i class="fas fa-user text-blue-600 mr-2"></i>Student
                        Info</h3>
                    <div class="space-y-1.5 text-xs">
                        <div class="flex justify-between"><span class="text-slate-600">Name:</span><span
                                class="font-semibold">{{ $app->student_name }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">DOB:</span><span
                                class="font-semibold">{{ $app->student_date_of_birth->format('d M, Y') }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Gender:</span><span
                                class="font-semibold">{{ ucwords($app->student_gender) }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Religion:</span><span
                                class="font-semibold">{{ ucwords($app->student_religion) }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Tribe:</span><span
                                class="font-semibold">{{ ucwords($app->student_tribe) }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Nationality:</span><span
                                class="font-semibold">{{ ucwords($app->student_nationality) }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">State Of Origin:</span><span
                                class="font-semibold">{{ ucwords($app->student_state) }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">LGA of Origin:</span><span
                                class="font-semibold">{{ ucwords($app->student_local_government) }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Address:</span><span
                                class="font-semibold">{{ ucwords($app->student_address) }}</span></div>

                    </div>
                </div>
                <div class="bg-white rounded-lg border border-slate-100 p-4">
                    <h3 class="text-xs font-bold text-slate-900 mb-3"><i
                            class="fas fa-school text-blue-600 mr-2"></i>Academic</h3>
                    <div class="space-y-1.5 text-xs">
                        <div class="flex justify-between"><span class="text-slate-600">Class Applied for:</span>
                            {{-- <span class="font-semibold">{{ $app->class->name }}</span> --}}
                        </div>
                        <div class="flex justify-between"><span class="text-slate-600">Session:</span><span
                                class="font-semibold">{{ $app->session->name }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Previous:</span><span
                                class="font-semibold">{{ $app->previous_school_name ?? 'No previous school' }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Last Class Attended:</span><span
                                class="font-semibold">{{ $app->last_class_attended ?? 'No previous school' }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Stream:</span><span
                                class="font-semibold">{{ ucwords($app->stream) }}</span></div>
                    </div>
                </div>
                <div class="bg-white rounded-lg border border-slate-100 p-4">
                    <h3 class="text-xs font-bold text-slate-900 mb-3"><i
                            class="fas fa-school text-blue-600 mr-2"></i>Programs</h3>
                    @forelse ($app->programs() as $program)
                        <div class="space-y-1.5 text-xs">
                            <div class="flex justify-between"><span class="text-slate-600">Program:</span><span
                                    class="font-semibold">{{ $program->name }}</span></div>
                                    <div class="flex justify-between"><span class="text-slate-600">Class Applied for:</span>
                                <span class="font-semibold">{{ $program->requestedClass->name }}</span>
                            </div>
                            <div class="flex justify-between"><span class="text-slate-600">Previous:</span><span
                                    class="font-semibold">{{ $app->previous_school_name ?? 'No previous school' }}</span>
                            </div>
                            <div class="flex justify-between"><span class="text-slate-600">Last Class Attended:</span><span
                                    class="font-semibold">{{ $app->last_class_attended ?? 'No previous school' }}</span>
                            </div>
                            <div class="flex justify-between"><span class="text-slate-600">Stream:</span><span
                                    class="font-semibold">{{ ucwords($app->stream) }}</span></div>
                        </div>
                    @empty
                    <div class="text-center text-sm text-slate-400">No program is requested this application</div>
                    @endforelse
                </div>
                <div class="bg-white rounded-lg border border-slate-100 p-4">
                    <h3 class="text-xs font-bold text-slate-900 mb-3"><i
                            class="fas fa-users text-blue-600 mr-2"></i>Guardian</h3>
                    <div class="space-y-1.5 text-xs">
                        <div class="flex justify-between"><span class="text-slate-600">Name:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->full_name ?: '—' }}
                                @else
                                    {{ $app->guardian_name ?: '—' }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between"><span class="text-slate-600">Relation:</span><span
                                class="font-semibold">{{ ucwords($app->guardian_relationship) }}</span></div>
                        <div class="flex justify-between"><span class="text-slate-600">DOB:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->date_of_birth?->format('d M, Y') ?? '—' }}
                                    @else{{ $app->guardian_date_of_birth?->format('d M, Y') ?? '—' }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between"><span class="text-slate-600">Gender:</span><span
                                class="font-semibold capitalize">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->gender ?: '—' }}
                                @else
                                    {{ $app->guardian_gender ?: '—' }}
                                @endif
                            </span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Phone:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->phone ?: '—' }}
                                @else
                                    {{ $app->guardian_phone ?: '—' }}
                                @endif
                            </span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Email:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->email ?: '—' }}
                                @else
                                    {{ $app->guardian_email ?: '—' }}
                                @endif
                            </span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Job:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    @if ($app->submittedBy->isStaff())
                                        Work as
                                        @forelse ($app->submittedBy->roles as $role)
                                            {{ $role . ', ' }}
                                        @empty
                                            staff
                                        @endforelse
                                        for the school
                                    @else
                                        {{ $app->guardian?->occupation ?: '—' }}
                                    @endif
                                @else
                                    {{ $app->guardian_occupation ?: '—' }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between"><span class="text-slate-600">Religion:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->religion ?: '—' }}
                                @else
                                    {{ $app->guardian_religion ?: '—' }}
                                @endif
                            </span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Tribe:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->tribe ?: '—' }}
                                @else
                                    {{ $app->guardian_tribe ?: '—' }}
                                @endif
                            </span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Nationality:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->nationality ?: '—' }}
                                @else
                                    {{ $app->guardian_nationality ?: '—' }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between"><span class="text-slate-600">State Of Origin:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->state ?: '—' }}
                                @else
                                    {{ $app->guardian_state ?: '—' }}
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between"><span class="text-slate-600">LGA of Origin:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->local_government ?: '—' }}
                                @else
                                    {{ $app->guardian_local_government ?: '—' }}
                                @endif
                            </span></div>
                        <div class="flex justify-between"><span class="text-slate-600">Address:</span><span
                                class="font-semibold">
                                @if ($app->submittedBy)
                                    {{ $app->submittedBy->address ?: '—' }}
                                @else
                                    {{ $app->guardian_address ?: '—' }}
                                @endif
                            </span></div>
                    </div>
                </div>
            </div>

            <!-- Documents Section -->
            <div class="bg-white rounded-lg border border-slate-100 p-5 mb-6">
                <h3 class="text-xs font-bold text-slate-900 mb-4"><i
                        class="fas fa-file-upload text-blue-600 mr-2"></i>Uploaded Documents</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                    <div class="border border-slate-200 rounded p-3 text-center hover:bg-slate-50">
                        <div class="text-lg text-blue-600 mb-2"><i class="fas fa-passport"></i></div>
                        <p class="text-xs font-semibold text-slate-900">Passport</p>
                        <div class="flex gap-1 mt-2">
                            <button
                                class="flex-1 bg-slate-100 text-slate-600 px-1.5 py-1 rounded text-xs hover:bg-slate-200"><i
                                    class="fas fa-eye"></i></button>
                            <button
                                class="flex-1 bg-slate-100 text-slate-600 px-1.5 py-1 rounded text-xs hover:bg-slate-200"><i
                                    class="fas fa-download"></i></button>
                        </div>
                    </div>
                    <div class="border border-slate-200 rounded p-3 text-center hover:bg-slate-50">
                        <div class="text-lg text-green-600 mb-2"><i class="fas fa-certificate"></i></div>
                        <p class="text-xs font-semibold text-slate-900">Birth Cert</p>
                        <div class="flex gap-1 mt-2">
                            <button
                                class="flex-1 bg-slate-100 text-slate-600 px-1.5 py-1 rounded text-xs hover:bg-slate-200"><i
                                    class="fas fa-eye"></i></button>
                            <button
                                class="flex-1 bg-slate-100 text-slate-600 px-1.5 py-1 rounded text-xs hover:bg-slate-200"><i
                                    class="fas fa-download"></i></button>
                        </div>
                    </div>
                    <div class="border border-slate-200 rounded p-3 text-center hover:bg-slate-50">
                        <div class="text-lg text-purple-600 mb-2"><i class="fas fa-chart-bar"></i></div>
                        <p class="text-xs font-semibold text-slate-900">Results</p>
                        <div class="flex gap-1 mt-2">
                            <button
                                class="flex-1 bg-slate-100 text-slate-600 px-1.5 py-1 rounded text-xs hover:bg-slate-200"><i
                                    class="fas fa-eye"></i></button>
                            <button
                                class="flex-1 bg-slate-100 text-slate-600 px-1.5 py-1 rounded text-xs hover:bg-slate-200"><i
                                    class="fas fa-download"></i></button>
                        </div>
                    </div>
                    <div class="border border-slate-200 rounded p-3 text-center hover:bg-slate-50">
                        <div class="text-lg text-red-600 mb-2"><i class="fas fa-heartbeat"></i></div>
                        <p class="text-xs font-semibold text-slate-900">Medical</p>
                        <div class="flex gap-1 mt-2">
                            <button
                                class="flex-1 bg-slate-100 text-slate-600 px-1.5 py-1 rounded text-xs hover:bg-slate-200"><i
                                    class="fas fa-eye"></i></button>
                            <button
                                class="flex-1 bg-slate-100 text-slate-600 px-1.5 py-1 rounded text-xs hover:bg-slate-200"><i
                                    class="fas fa-download"></i></button>
                        </div>
                    </div>
                    <div class="border border-slate-200 rounded p-3 text-center hover:bg-slate-50">
                        <div class="text-lg text-orange-600 mb-2"><i class="fas fa-file-alt"></i></div>
                        <p class="text-xs font-semibold text-slate-900">Reference</p>
                        <div class="flex gap-1 mt-2">
                            <button
                                class="flex-1 bg-slate-100 text-slate-600 px-1.5 py-1 rounded text-xs hover:bg-slate-200"><i
                                    class="fas fa-eye"></i></button>
                            <button
                                class="flex-1 bg-slate-100 text-slate-600 px-1.5 py-1 rounded text-xs hover:bg-slate-200"><i
                                    class="fas fa-download"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-2">
                <button class="bg-slate-100 text-slate-600 px-4 py-2 rounded text-xs font-semibold hover:bg-slate-200">
                    <i class="fas fa-download mr-1"></i>
                    Download All
                </button>

                @if ($app->status === 'pending')
                    <form method="POST" action="{{ route('applications.reject', $app) }}">
                        @csrf
                        @method('PUT')

                        <button onclick="showLoader()" type="submit"
                            class="bg-rose-50 text-rose-600 px-4 py-2 rounded text-xs font-semibold border border-rose-200 hover:bg-rose-100 flex items-center gap-1">
                            <i class="fas fa-times"></i>
                            Reject
                        </button>
                    </form>
                @endif


                @if ($app->status === 'pending')
                    <form method="POST" action="{{ route('applications.approve', $app) }}">
                        @csrf
                        @method('PUT')

                        <button onclick="showLoader()" type="submit"
                            class="bg-emerald-50 text-emerald-600 px-4 py-2 rounded text-xs font-semibold border border-emerald-200 hover:bg-emerald-100 flex items-center gap-1">
                            <i class="fas fa-check"></i>
                            Approve
                        </button>
                    </form>
                @endif


                @if ($app->status === 'rejected')
                    <form method="POST" action="{{ route('applications.approve', $app) }}">
                        @csrf
                        @method('PUT')

                        <button onclick="showLoader()" type="submit"
                            class="bg-amber-50 text-amber-600 px-4 py-2 rounded text-xs font-semibold border border-amber-200 hover:bg-amber-100 flex items-center gap-1">
                            <i class="fas fa-redo"></i>
                            Reconsider & Approve
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </main>
    </div>
@endsection
