@extends('layouts.guest.app')

@section('title', 'Application Details')

@section('page-content')
    <main class="flex-grow">
        <header class="bg-navy-900 text-white py-12 mb-10">
            <div class="container mx-auto px-4 text-center" data-aos="fade-up">
                <h1 class="text-3xl font-extrabold mb-3 tracking-tight">
                    Application Submitted
                </h1>
                <p class="text-gray-300 max-w-xl mx-auto text-sm">
                    Your admission application has been received successfully. Please save your application number for
                    future reference.
                </p>
            </div>
        </header>

        <main class="container mx-auto px-4 pb-20">
            <div class="max-w-5xl mx-auto space-y-8">

                @if (session('success'))
                    <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl px-4 py-3 text-sm"
                        data-aos="fade-up">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-circle-check mt-0.5"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('failure'))
                    <div class="bg-rose-50 border border-rose-100 text-rose-700 rounded-xl px-4 py-3 text-sm"
                        data-aos="fade-up">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-circle-exclamation mt-0.5"></i>
                            <span>{{ session('failure') }}</span>
                        </div>
                    </div>
                @endif

                <section class="bg-white p-8 md:p-10 rounded-xl border border-gray-200 shadow-sm" data-aos="fade-up">
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-gray-400 font-bold mb-2">
                                Application Reference
                            </p>
                            <h2 class="text-2xl md:text-3xl font-extrabold text-navy-900 leading-tight">
                                {{ $application->application_number }}
                            </h2>
                            <p class="text-sm text-gray-500 mt-2">
                                Submitted {{ $application->created_at->format('d M, Y \a\t h:i A') }}
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 sm:items-center">
                            @php
                                $statusClasses = match ($application->status) {
                                    'approved' => 'bg-emerald-50 text-emerald-700 border border-emerald-100',
                                    'rejected' => 'bg-rose-50 text-rose-700 border border-rose-100',
                                    'withdrawn' => 'bg-slate-100 text-slate-700 border border-slate-200',
                                    default => 'bg-amber-50 text-amber-700 border border-amber-100',
                                };

                                $statusIcon = match ($application->status) {
                                    'approved' => 'fa-check-circle',
                                    'rejected' => 'fa-times-circle',
                                    'withdrawn' => 'fa-ban',
                                    default => 'fa-clock',
                                };
                            @endphp

                            <div
                                class="px-4 py-2 rounded-lg text-xs font-semibold flex items-center gap-2 {{ $statusClasses }}">
                                <i class="fas {{ $statusIcon }}"></i>
                                <span class="capitalize">{{ $application->status }}</span>
                            </div>

                            @if ($application->status === 'pending')
                                <form method="POST" id="withdrawal-form"
                                    action="{{ route('applications.withdraw', $application) }}">
                                    @csrf
                                    @method('PUT')

                                    <button type="button" onclick="openWithdrawModal()"
                                        class="bg-rose-50 text-rose-600 px-4 py-2 rounded-lg text-xs font-semibold hover:bg-rose-100 transition-all border border-rose-100 flex items-center gap-2">
                                        <i class="fas fa-ban"></i>
                                        Withdraw Application
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="info-card">
                            <p class="detail-label">Application ID</p>
                            <p class="detail-value">{{ $application->id }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Session</p>
                            <p class="detail-value">{{ $application->session?->name ?? 'Not specified' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Expected Decision</p>
                            <p class="detail-value">{{ $application->expected_decision }}</p>
                        </div>
                    </div>
                </section>

                <section class="bg-white p-8 md:p-10 rounded-xl border border-gray-200 shadow-sm" data-aos="fade-up">
                    <h2 class="section-title">Student Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="info-card">
                            <p class="detail-label">First Name</p>
                            <p class="detail-value">{{ $application->student_first_name ?: '—' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Middle Name</p>
                            <p class="detail-value">{{ $application->student_middle_name ?: '—' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Last Name</p>
                            <p class="detail-value">{{ $application->student_last_name ?: '—' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Date of Birth</p>
                            <p class="detail-value">{{ $application->student_date_of_birth?->format('d M, Y') ?? '—' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Gender</p>
                            <p class="detail-value capitalize">{{ $application->student_gender ?: '—' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Nationality</p>
                            <p class="detail-value">{{ $application->student_nationality ?: '—' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">State</p>
                            <p class="detail-value">{{ $application->student_state ?: '—' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Local Government</p>
                            <p class="detail-value">{{ $application->student_local_government ?: '—' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Religion</p>
                            <p class="detail-value">{{ $application->student_religion ?: '—' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Tribe</p>
                            <p class="detail-value">{{ $application->student_tribe ?: '—' }}</p>
                        </div>

                        <div class="info-card md:col-span-2 lg:col-span-2">
                            <p class="detail-label">Residential Address</p>
                            <p class="detail-value">{{ $application->student_address ?: '—' }}</p>
                        </div>
                    </div>
                </section>

                <section class="bg-white p-8 md:p-10 rounded-xl border border-gray-200 shadow-sm" data-aos="fade-up">
                    <h2 class="section-title">Academic Details</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="info-card">
                            <p class="detail-label">Class Applied For</p>
                            <p class="detail-value">{{ $application->class?->name ?? 'Not specified' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Stream</p>
                            <p class="detail-value capitalize">{{ $application->stream ?: 'General' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Current Status</p>
                            <p class="detail-value capitalize">{{ $application->status }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Previous School Name</p>
                            <p class="detail-value">
                                {{ $application->previous_school_name ?: 'No previous school provided' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Last Class Attended</p>
                            <p class="detail-value">{{ $application->last_class_attended ?: 'Not provided' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Application Date</p>
                            <p class="detail-value">{{ $application->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </section>

                <section class="bg-white p-8 md:p-10 rounded-xl border border-gray-200 shadow-sm" data-aos="fade-up">
                    <h2 class="section-title">Parent / Guardian Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="info-card">
                            <p class="detail-label">First Name</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->first_name ?: '—' }}
                                @else
                                    {{ $application->guardian_first_name ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Middle Name</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->middle_name ?: '—' }}
                                @else
                                    {{ $application->guardian_middle_name ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Last Name</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->last_name ?: '—' }}
                                @else
                                    {{ $application->guardian_last_name ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Relationship</p>
                            <p class="detail-value capitalize">{{ $application->guardian_relationship ?: '—' }}</p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Phone</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->phone ?: '—' }}
                                @else
                                    {{ $application->guardian_phone ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Email</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->email ?: '—' }}
                                @else
                                    {{ $application->guardian_email ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Date of Birth</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->date_of_birth?->format('d M, Y') ?? '—' }}
                                    @else{{ $application->guardian_date_of_birth?->format('d M, Y') ?? '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Gender</p>
                            <p class="detail-value capitalize">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->gender ?: '—' }}
                                @else
                                    {{ $application->guardian_gender ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Occupation</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    @if ($application->submittedBy->isStaff())
                                        Work as
                                        @forelse ($application->submittedBy->roles as $role)
                                            {{ $role . ', ' }}
                                        @empty
                                            staff
                                        @endforelse
                                        for the school
                                    @else
                                        {{ $application->guardian?->occupation ?: '—' }}
                                    @endif
                                @else
                                    {{ $application->guardian_occupation ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Nationality</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->nationality ?: '—' }}
                                @else
                                    {{ $application->guardian_nationality ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">State</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->state ?: '—' }}
                                @else
                                    {{ $application->guardian_state ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Local Government</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->local_government ?: '—' }}
                                @else
                                    {{ $application->guardian_local_government ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Religion</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->religion ?: '—' }}
                                @else
                                    {{ $application->guardian_religion ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card">
                            <p class="detail-label">Tribe</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->tribe ?: '—' }}
                                @else
                                    {{ $application->guardian_tribe ?: '—' }}
                                @endif
                            </p>
                        </div>

                        <div class="info-card md:col-span-2 lg:col-span-2">
                            <p class="detail-label">Residential Address</p>
                            <p class="detail-value">
                                @if ($application->submittedBy)
                                    {{ $application->submittedBy->address ?: '—' }}
                                @else
                                    {{ $application->guardian_address ?: '—' }}
                                @endif
                            </p>
                        </div>
                    </div>
                </section>

                <section class="bg-navy-50 border border-navy-100 rounded-xl p-6 md:p-8" data-aos="fade-up">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                        <div>
                            <h3 class="text-base font-bold text-navy-900 mb-2">
                                Important Note
                            </h3>
                            <p class="text-sm text-gray-600 max-w-2xl">
                                Keep your application number safe. You may need it to track your application or contact the
                                school regarding your admission.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('applications.create') }}"
                                class="bg-white text-navy-900 border border-gray-200 px-4 py-2 rounded-lg text-xs font-semibold hover:bg-gray-50 transition-all flex items-center gap-2">
                                <i class="fas fa-plus"></i>
                                New Application
                            </a>

                            <button onclick="window.print()"
                                class="bg-[#6B8DD6] text-white px-4 py-2 rounded-lg text-xs font-semibold hover:bg-opacity-90 transition-all flex items-center gap-2">
                                <i class="fas fa-print"></i>
                                Print Details
                            </button>
                        </div>
                    </div>
                </section>

            </div>
        </main>
    </main>
    <div id="withdrawModal" class="modal">
        <div class="modal-content">
            <div class="mb-4">
                <i class="fas fa-exclamation-triangle text-rose-600 text-3xl block text-center mb-3"></i>
                <h3 class="text-base font-bold text-slate-800 text-center">Withdraw Application?</h3>
            </div>

            <p class="text-xs text-slate-600 text-center mb-6">
                Are you sure? This action cannot be undone.
            </p>

            <div class="flex gap-2">
                <button type="button" onclick="closeWithdrawModal()"
                    class="flex-1 px-4 py-2 bg-slate-100 text-slate-700 rounded text-xs font-semibold hover:bg-slate-200">
                    Cancel
                </button>

                <button type="button" onclick="confirmWithdraw()"
                    class="flex-1 px-4 py-2 bg-rose-600 text-white rounded text-xs font-semibold hover:bg-rose-700">
                    Withdraw
                </button>
            </div>
        </div>
    </div>

    <script>
        function openWithdrawModal() {
            document.getElementById('withdrawModal').classList.add('active');
        }

        function closeWithdrawModal() {
            document.getElementById('withdrawModal').classList.remove('active');
        }

        function confirmWithdraw() {
            document.getElementById('withdrawal-form').submit();
        }

        document.getElementById('withdrawModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeWithdrawModal();
            }
        });
    </script>

@endsection
