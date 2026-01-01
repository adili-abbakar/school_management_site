@extends('layouts.guest.app')

@section('title', 'Apply For Admission')

@section('page-content')

    <main class="flex-grow">
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
                <form action="#" class="space-y-8 bg-white p-8 md:p-12 rounded-xl border border-gray-200 shadow-sm"
                    data-aos="fade-up">
                    <!-- Student Details -->
                    <section>
                        <h2 class="section-title">Student Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="form-label">First Name <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter first name" required />
                            </div>
                            <div>
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-input" placeholder="Enter middle name" />
                            </div>
                            <div>
                                <label class="form-label">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Enter last name" required />
                            </div>
                            <div>
                                <label class="form-label">Date of Birth <span class="text-red-500">*</span></label>
                                <input type="date" class="form-input" required />
                            </div>
                            <div>
                                <label class="form-label">Gender <span class="text-red-500">*</span></label>
                                <select class="form-input" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Nationality <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="e.g. American" required />
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
                                <select class="form-input" required>
                                    <option value="">Select Class</option>
                                    <option value="jss1">JSS 1</option>
                                    <option value="jss2">JSS 2</option>
                                    <option value="ss1">SS 1</option>
                                    <option value="ss2">SS 2</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Previous School Name</label>
                                <input type="text" class="form-input" placeholder="Name of last school" />
                            </div>
                            <div>
                                <label class="form-label">Last Class Attended</label>
                                <input type="text" class="form-input" placeholder="e.g. Grade 5" />
                            </div>
                        </div>
                    </section>

                    <!-- Parent/Guardian Information -->
                    <section>
                        <h2 class="section-title">Parent / Guardian Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="form-label">Guardian Full Name
                                    <span class="text-red-500">*</span></label>
                                <input type="text" class="form-input" placeholder="Full name of guardian" required />
                            </div>
                            <div>
                                <label class="form-label">Relationship <span class="text-red-500">*</span></label>
                                <select class="form-input" required>
                                    <option value="">Select Relationship</option>
                                    <option value="father">Father</option>
                                    <option value="mother">Mother</option>
                                    <option value="relative">Relative</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Primary Phone <span class="text-red-500">*</span></label>
                                <input type="tel" class="form-input" placeholder="+1 (555) 000-0000" required />
                            </div>
                            <div class="lg:col-span-2">
                                <label class="form-label">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" class="form-input" placeholder="guardian@example.com" required />
                            </div>
                            <div>
                                <label class="form-label">Occupation</label>
                                <input type="text" class="form-input" placeholder="e.g. Teacher" />
                            </div>
                            <div class="lg:col-span-3">
                                <label class="form-label">Residential Address
                                    <span class="text-red-500">*</span></label>
                                <textarea class="form-input h-20 resize-none" placeholder="Enter full home address" required></textarea>
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
@endsection
