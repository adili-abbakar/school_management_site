@extends('layouts.app')

@section('title', 'Academic Staffs Form')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header />


        <div class="p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Create New Teacher</h1>
                    <p class="text-slate-500 text-xs">Add a new teaching staff member to the system.</p>
                </div>
                <a href="{{ url()->previous() }}"
                    class="bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-md hover:bg-slate-300 transition-all flex items-center gap-1.5">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to List</span>
                </a>
            </div>

            <!-- Responsive 2-3 column form grid for teacher creation -->
            <form class="bg-white rounded-xl border border-slate-100 shadow-sm p-4 md:p-6">
                <div class="mb-6">
                    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
                        <i class="fas fa-user text-accent text-xs"></i>
                        Personal Information
                    </h3>
                    <p class="text-xs text-slate-500">Basic details about the teacher</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">First Name *</label>
                        <input type="text" placeholder="Enter first name"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Middle Name</label>
                        <input type="text" placeholder="Enter middle name"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Last Name *</label>
                        <input type="text" placeholder="Enter last name"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Email Address *</label>
                        <input type="email" placeholder="teacher@example.com"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Phone Number *</label>
                        <input type="tel" placeholder="+1 (555) 000-0000"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Date of Birth *</label>
                        <input type="date"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Gender *</label>
                        <select
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                            <option value="">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">National ID Number</label>
                        <input type="text" placeholder="Enter ID number"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Religion</label>
                        <select
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
                            <option value="">Select religion</option>
                            <option value="christianity">Christianity</option>
                            <option value="islam">Islam</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
                        <i class="fas fa-graduation-cap text-accent text-xs"></i>
                        Professional Information
                    </h3>
                    <p class="text-xs text-slate-500">Teaching qualifications and experience</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Staff ID Number *</label>
                        <input type="text" placeholder="e.g., TCH001"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Subject Specialization
                            *</label>
                        <select
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                            <option value="">Select subject</option>
                            <option value="mathematics">Mathematics</option>
                            <option value="english">English Language</option>
                            <option value="science">Science</option>
                            <option value="social_studies">Social Studies</option>
                            <option value="arts">Arts</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Highest Qualification
                            *</label>
                        <select
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                            <option value="">Select qualification</option>
                            <option value="bachelors">Bachelor's Degree</option>
                            <option value="masters">Master's Degree</option>
                            <option value="phd">PhD/Doctorate</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Years of
                            Experience</label>
                        <input type="number" placeholder="Enter years" min="0"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Employment Type *</label>
                        <select
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                            <option value="">Select type</option>
                            <option value="full_time">Full Time</option>
                            <option value="part_time">Part Time</option>
                            <option value="contract">Contract</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Date of Joining *</label>
                        <input type="date"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-accent text-xs"></i>
                        Address Information
                    </h3>
                    <p class="text-xs text-slate-500">Residential address details</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <div class="md:col-span-2 lg:col-span-3">
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Street Address *</label>
                        <input type="text" placeholder="Enter street address"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">City *</label>
                        <input type="text" placeholder="Enter city"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">State/Region *</label>
                        <input type="text" placeholder="Enter state"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Postal Code</label>
                        <input type="text" placeholder="Enter postal code"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-6 border-t border-slate-100">
                    <button type="submit"
                        class="bg-accent text-white px-5 py-2 rounded-lg text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>Create Teacher Account</span>
                    </button>
                    <button type="reset"
                        class="bg-slate-200 text-slate-700 px-5 py-2 rounded-lg text-xs font-semibold hover:bg-slate-300 transition-all flex items-center gap-2">
                        <i class="fas fa-redo"></i>
                        <span>Reset Form</span>
                    </button>
                    <a href="dashboard-teachers.html"
                        class="bg-slate-100 text-slate-600 px-5 py-2 rounded-lg text-xs font-semibold hover:bg-slate-200 transition-all flex items-center gap-2">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </main>
@endsection
