@extends('layouts.guest.app')

@section('title', 'Apply For Admission')

@section('page-content')
    <main class="grow">
        <x-loader-component />

        <!-- Header Section -->
        <header class="bg-navy-900 text-white py-12 mb-10">
            <div class="container mx-auto px-4 text-center" data-aos="fade-up">
                <h1 class="text-3xl font-extrabold mb-3 tracking-tight">
                    Admission Application
                </h1>
                <p class="text-gray-300 max-w-xl mx-auto text-sm">
                    Please provide accurate information to begin the enrollment process.
                    Fields marked with <span class="text-red-400">*</span> are required.
                </p>
            </div>
        </header>

        <!-- Application Form -->
        <section class="container mx-auto px-4 pb-20">
            <div class="max-w-5xl mx-auto">
                <form action="{{ route('applications.store') }}" method="POST"
                    class="form space-y-8 bg-white p-8 md:p-12 rounded-xl border border-gray-200 shadow-sm"
                    data-aos="fade-up">
                    @csrf


                    @include('application.partials.student-fields')


                    @auth
                        <section>
                            <h2 class="section-title">Parent / Guardian Information</h2>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="form-label">Relationship to student<span class="text-red-500">*</span></label>
                                    <select class="form-input" name="guardian_relationship">
                                        <option value="">Select Relationship</option>
                                        <option value="father">Father</option>
                                        <option value="mother">Mother</option>
                                        <option value="brother">Brother</option>
                                        <option value="sister">Sister</option>
                                        <option value="grandfather">Grandfather</option>
                                        <option value="grandmother">Grandmother</option>
                                        <option value="uncle">Uncle</option>
                                        <option value="aunt">Aunt</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <span class="text-red-600 text-[10px] error-message"
                                        data-name="guardian_relationship"></span>
                                </div>
                            </div>
                        </section>
                    @endauth
                    @guest
                        @include('application.partials.guardian-feilds')
                    @endguest

                    <!-- Documents Upload -->
                    <section>
                        <h2 class="section-title">Document Uploads</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div
                                class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-blue-300 transition-colors">
                                <i class="fas fa-image text-gray-300 text-2xl mb-2"></i>
                                <label class="block text-[11px] font-bold text-gray-400 mb-2 uppercase">Passport
                                    Photograph</label>
                                <input type="file"
                                    class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            </div>
                            <div
                                class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-blue-300 transition-colors">
                                <i class="fas fa-file-pdf text-gray-300 text-2xl mb-2"></i>
                                <label class="block text-[11px] font-bold text-gray-400 mb-2 uppercase">Last Result
                                    Sheet</label>
                                <input type="file"
                                    class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            </div>
                        </div>
                    </section>

                    <!-- Academic Information -->
                    <section>
                        <h2 class="section-title">Academic Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="form-label">Stream (for SS classes only)</label>
                                <select name="stream" class="form-input">
                                    <option value="">Choose stream</option>
                                    <option value="science">Science (SS Classes only)</option>
                                    <option value="arts">Arts (SS Classes only)</option>
                                </select>
                                <span class="text-red-600 text-[10px] error-message" data-name="stream"></span>
                            </div>
                            <div>
                                <label class="form-label">Previous School Name</label>
                                <input type="text" class="form-input" placeholder="Name of last school"
                                    name="previous_school_name" />
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="previous_school_name"></span>
                            </div>
                            <div>
                                <label class="form-label">Last Class Attended</label>
                                <input type="text" class="form-input" placeholder="e.g. Grade 5"
                                    name="last_class_attended" />
                                <span class="text-red-600 text-[10px] error-message" data-name="last_class_attended"></span>
                            </div>
                        </div>


                    </section>

                    <!-- Program Information -->
                    <section class="space-y-4">
                        <h2 class="section-title">Choose Program(s) for you child</h2>
                        <span class="text-red-600 text-[13px] error-message" data-name="programs"></span>
                        <br>
                        @forelse ($programs as $program)
                            <div class="program-card border border-slate-200 rounded-xl p-4 cursor-pointer transition-all"
                                data-program="{{ $program->id }}">

                                <input type="checkbox" name="programs[{{ $loop->index }}][program_id]"
                                    data-field="program_id" value="{{ $program->id }}" class="hidden program-checkbox">

                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold text-slate-800">
                                            {{ $program->name }}
                                        </h3>

                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ Str::limit($program->description, 120) }}
                                        </p>
                                    </div>

                                    <div class="program-indicator hidden">
                                        ✓
                                    </div>
                                </div>

                                <div class="program-class-container hidden mt-4">
                                    <label class="form-label">
                                        Class Applying For
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <select name="programs[{{ $loop->index }}][requested_class]"
                                        data-field="requested_class" class="form-input" disabled>
                                        <option value="">Select Class</option>

                                        @foreach ($program->classes as $class)
                                            <option value="{{ $class->id }}">
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-red-600 text-[11px] error-message"
                                        data-name="programs.{{ $loop->index }}.requested_class"></span>
                                </div>
                            </div>
                        @empty
                            <div
                                class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center text-sm">
                                No Active program found, contact the school management for futher information.
                            </div>
                        @endforelse
                    </section>

                    <div id="globalError" class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out mb-4">
                        <div
                            class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                            <span class="text-sm font-medium"></span>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="flex items-start gap-3 max-w-md">
                            <input type="checkbox" id="terms"
                                class="mt-1 w-4 h-4 rounded border-gray-300 text-navy-900 focus:ring-navy-900" required />
                            <label for="terms" class="text-[11px] text-gray-500 leading-tight">
                                I hereby certify that the information provided is accurate and
                                complete. I understand that any false information may lead to
                                disqualification.
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full md:w-auto px-10 py-4 bg-[#6B8DD6] text-white rounded-lg font-bold text-sm hover:bg-opacity-90 shadow-lg shadow-blue-900/10 transition-all transform hover:-translate-y-1">
                            SUBMIT APPLICATION
                            <i class="fas fa-paper-plane ml-2 text-[10px]"></i>
                        </button>
                    </div>
                </form>
            </div>
        </section>

    </main>
    <script src="{{ asset('/js/formSubmitter.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            document.querySelectorAll(".program-card").forEach(card => {

                card.addEventListener("click", (e) => {

                    // Prevent double-trigger when clicking select
                    if (
                        e.target.tagName === "SELECT" ||
                        e.target.tagName === "OPTION"
                    ) {
                        return;
                    }

                    const checkbox = card.querySelector(".program-checkbox");
                    const classContainer = card.querySelector(".program-class-container");
                    const indicator = card.querySelector(".program-indicator");
                    const select = card.querySelector("select");

                    checkbox.checked = !checkbox.checked;

                    if (checkbox.checked) {

                        select.disabled = false;

                        card.classList.add(
                            "border-accent",
                            "bg-blue-50",
                            "ring-2",
                            "ring-accent"
                        );

                        classContainer.classList.remove("hidden");
                        indicator.classList.remove("hidden");

                    } else {

                        select.disabled = true;
                        select.value = "";

                        card.classList.remove(
                            "border-accent",
                            "bg-blue-50",
                            "ring-2",
                            "ring-accent"
                        );

                        classContainer.classList.add("hidden");
                        indicator.classList.add("hidden");
                    }

                });

            });

        });
    </script>
@endsection
