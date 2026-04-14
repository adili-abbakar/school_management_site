@extends('layouts.guest.app')

@section('title', 'Apply For Admission')

@section('page-content')
    <main class="flex-grow">
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

                    <!-- Student Details -->
                    <section>
                        <h2 class="section-title">Student Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="form-label">First Name <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter first name"
                                    name="student_first_name" />
                                <span class="text-red-600 text-[10px] error-message" data-name="student_first_name"></span>
                            </div>
                            <div>
                                <label class="form-label">Middle Name <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter middle name"
                                    name = 'student_middle_name' />
                                <span class="text-red-600 text-[10px] error-message" data-name="student_middle_name"></span>
                            </div>
                            <div>
                                <label class="form-label">Last Name </label>
                                <input type="text" class="form-input" placeholder="Enter last name"
                                    name="student_last_name" />
                                <span class="text-red-600 text-[10px] error-message" data-name="student_last_name"></span>
                            </div>
                            <div>
                                <label class="form-label">Date of Birth <span class="text-red-500">*</span></label>
                                <input type="date" class="form-input" name="student_date_of_birth" />
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="student_date_of_birth"></span>
                            </div>
                            <div>
                                <label class="form-label">Gender <span class="text-red-500">*</span></label>
                                <select class="form-input" name="student_gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="text-red-600 text-[10px] error-message" data-name="student_gender"></span>
                            </div>
                            <div>
                                <label class="form-label">Religion <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="e.g. Islam, Christianity"
                                    name="student_religion" />
                                <span class="text-red-600 text-[10px] error-message" data-name="student_religion"></span>
                            </div>
                            <div>
                                <label class="form-label">Tribe <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="e.g. Hausa, Igbo, Yourba"
                                    name="student_tribe" />
                                <span class="text-red-600 text-[10px] error-message" data-name="student_tribe"></span>
                            </div>
                            <div>
                                <label class="form-label">Nationality of origin <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter Country"
                                    name="student_nationality" />
                                <span class="text-red-600 text-[10px] error-message" data-name="student_nationality"></span>
                            </div>
                            <div>
                                <label class="form-label">State of origin <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter State" name="student_state" />
                                <span class="text-red-600 text-[10px] error-message" data-name="student_state"></span>
                            </div>
                            <div>
                                <label class="form-label">Local goverment area of origin <span
                                        class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter Local goverment area"
                                    name="student_local_government" />
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="student_local_government"></span>
                            </div>

                            <div class="lg:col-span-3">
                                <label class="form-label">Residential Address
                                    <span class="text-red-500">*</span></label>
                                <textarea class="form-input h-20 resize-none" placeholder="Enter full home address" name="student_address"></textarea>
                                <span class="text-red-600 text-[10px] error-message" data-name="student_address"></span>
                            </div>
                        </div>
                    </section>

                    <!-- Academic Information -->
                    <section>
                        <h2 class="section-title">Academic Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="form-label">Class Applying For
                                    <span class="text-red-500">*</span></label>
                                <select class="form-input" name="class_id">
                                    <option value="">Select Class</option>
                                    @forelse ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @empty
                                        <option value="">No Class is created, contact the school management</option>
                                    @endforelse
                                </select>
                                <span class="text-red-600 text-[10px] error-message" data-name="class_id"></span>
                            </div>
                            <div>
                                <label for="form-label">Stream</label>
                                <select name="stream" class="form-input">
                                    <option value="general">General</option>
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
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="last_class_attended"></span>
                            </div>
                        </div>
                    </section>

                    <!-- Parent/Guardian Information -->
                    <section>
                        <h2 class="section-title">Parent / Guardian Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="form-label">First Name <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter first name"
                                    name="guardian_first_name" />
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="guardian_first_name"></span>
                            </div>
                            <div>
                                <label class="form-label">Middle Name <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter middle name"
                                    name="guardian_middle_name" />
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="guardian_middle_name"></span>
                            </div>
                            <div>
                                <label class="form-label">Last Name </label>
                                <input type="text" class="form-input" placeholder="Enter last name"
                                    name="guardian_last_name" />
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="guardian_last_name"></span>
                            </div>
                            <div>
                                <label class="form-label">Date of Birth <span class="text-red-500">*</span></label>
                                <input type="date" class="form-input" name="guardian_date_of_birth" />
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="guardian_date_of_birth"></span>
                            </div>
                            <div>
                                <label class="form-label">Gender <span class="text-red-500">*</span></label>
                                <select class="form-input" name="guardian_gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <span class="text-red-600 text-[10px] error-message" data-name="guardian_gender"></span>
                            </div>
                            <div>
                                <label class="form-label">Religion <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="e.g. Islam, Christianity"
                                    name="guardian_religion" />
                                <span class="text-red-600 text-[10px] error-message" data-name="guardian_religion"></span>
                            </div>
                            <div>
                                <label class="form-label">Tribe <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="e.g. Hausa, Igbo, Yourba"
                                    name="guardian_tribe" />
                                <span class="text-red-600 text-[10px] error-message" data-name="guardian_tribe"></span>
                            </div>
                            <div>
                                <label class="form-label">Nationality of origin <span
                                        class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter Country"
                                    name="guardian_nationality" />
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="guardian_nationality"></span>
                            </div>
                            <div>
                                <label class="form-label">State of origin <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter State"
                                    name="guardian_state" />
                                <span class="text-red-600 text-[10px] error-message" data-name="guardian_state"></span>
                            </div>
                            <div>
                                <label class="form-label">Local goverment area of origin <span
                                        class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter Local goverment area"
                                    name="guardian_local_government" />
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="guardian_local_government"></span>
                            </div>
                            <div>
                                <label class="form-label">Relationship <span class="text-red-500">*</span></label>
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
                            <div>
                                <label class="form-label">Primary Phone <span class="text-red-500">*</span></label>
                                <input type="tel" class="form-input" placeholder="+1 (555) 000-0000"
                                    name="guardian_phone" />
                                <span class="text-red-600 text-[10px] error-message" data-name="guardian_phone"></span>
                            </div>
                            <div class="lg:col-span-2">
                                <label class="form-label">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" class="form-input" placeholder="guardian@example.com"
                                    name="guardian_email" />
                                <span class="text-red-600 text-[10px] error-message" data-name="guardian_email"></span>
                            </div>
                            <div>
                                <label class="form-label">Occupation <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="e.g. Teacher"
                                    name="guardian_occupation" />
                                <span class="text-red-600 text-[10px] error-message"
                                    data-name="guardian_occupation"></span>
                            </div>

                            <div class="lg:col-span-3">
                                <label class="form-label">Residential Address
                                    <span class="text-red-500">*</span></label>
                                <textarea class="form-input h-20 resize-none" placeholder="Enter full home address" name="guardian_address"></textarea>
                                <span class="text-red-600 text-[10px] error-message" data-name="guardian_address"></span>
                            </div>

                        </div>
                    </section>

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

                    <div id="globalError" class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out mb-4">
                        <div
                            class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                            <span class="text-sm font-medium"></span>
                        </div>
                    </div>
                    <div
                        class="pt-6 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
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
@endsection
