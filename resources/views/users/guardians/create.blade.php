@extends('layouts.app')

@section('title', 'Guardians & Parents Form')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header />

        <div class="p-4 md:p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Create New Guardian</h1>
                    <p class="text-slate-500 text-xs">Add a new guardian/parent to the system.</p>
                </div>
                <a href="{{ url()->previous() }}"
                    class="bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-md hover:bg-slate-300 transition-all flex items-center gap-1.5">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to List</span>
                </a>
            </div>

            <!-- Responsive 2-3 column form grid for guardian creation -->
            <form class="bg-white rounded-xl border border-slate-100 shadow-sm p-4 md:p-6">
                <div class="mb-6">
                    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
                        <i class="fas fa-user text-accent text-xs"></i>
                        Personal Information
                    </h3>
                    <p class="text-xs text-slate-500">Basic details about the guardian</p>
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
                        <input type="email" placeholder="guardian@example.com"
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
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Alternate Phone</label>
                        <input type="tel" placeholder="+1 (555) 000-0000"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Relationship to Student
                            *</label>
                        <select
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                            <option value="">Select relationship</option>
                            <option value="father">Father</option>
                            <option value="mother">Mother</option>
                            <option value="guardian">Legal Guardian</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Occupation</label>
                        <input type="text" placeholder="Enter occupation"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">National ID Number</label>
                        <input type="text" placeholder="Enter ID number"
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
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

                <div class="mb-6">
                    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
                        <i class="fas fa-user-graduate text-accent text-xs"></i>
                        Student Association
                    </h3>
                    <p class="text-xs text-slate-500">Link guardian to students</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Select Student(s)
                            *</label>
                        <select
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            multiple required>
                            <option value="1">John Doe - JSS 1 Gold</option>
                            <option value="2">Sarah Smith - SS 3 Science</option>
                            <option value="3">Michael Johnson - JSS 2 Blue</option>
                        </select>
                        <p class="text-[9px] text-slate-400 mt-1">Hold Ctrl/Cmd to select multiple students</p>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Primary Contact *</label>
                        <select
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
                            required>
                            <option value="">Is this primary contact?</option>
                            <option value="yes">Yes - Primary Contact</option>
                            <option value="no">No - Secondary Contact</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-6 border-t border-slate-100">
                    <button type="submit"
                        class="bg-accent text-white px-5 py-2 rounded-lg text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>Create Guardian Account</span>
                    </button>
                    <button type="reset"
                        class="bg-slate-200 text-slate-700 px-5 py-2 rounded-lg text-xs font-semibold hover:bg-slate-300 transition-all flex items-center gap-2">
                        <i class="fas fa-redo"></i>
                        <span>Reset Form</span>
                    </button>
                    <a href="dashboard-guardians.html"
                        class="bg-slate-100 text-slate-600 px-5 py-2 rounded-lg text-xs font-semibold hover:bg-slate-200 transition-all flex items-center gap-2">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </main>
@endsection
