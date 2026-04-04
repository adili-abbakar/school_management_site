@extends('layouts.app')

@section('title', 'Class Details')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header>
            <div class="flex items-center gap-4 flex-grow max-w-xl">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Search students..."
                        class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                </div>
            </div>
        </x-dashboard-header>
        <x-loader-component />
        <div class="p-6">
            <div class="mb-6">
                <x-buttons.blue-back-to-list />
                <h1 class="text-xl font-extrabold text-primary">{{ $arm->fullName }} - Class Details</h1>
                <p class="text-slate-500 text-xs">Complete information for {{ $arm->fullName }} class arm</p>
            </div>

            <!-- Class Information Card -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                    <h3 class="text-sm font-bold text-primary mb-4">Class Information</h3>
                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-slate-600">Class Name:</span>
                            <span class="font-semibold text-primary">{{ $arm->fullName }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-slate-600">Class Level:</span>
                            <span class="font-semibold text-primary">{{ ucwords($arm->class->level) }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-slate-600">Arm Name:</span>
                            <span class="font-semibold text-primary">{{ $arm->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Status:</span>
                            <span
                                class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-[9px] font-semibold">Active</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                    <h3 class="text-sm font-bold text-primary mb-4">Teacher Information</h3>
                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-slate-600">Form Teacher:</span>
                            <span class="font-semibold text-primary">{{ $arm->teacher->name() }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-slate-600">Qualification:</span>
                            <span
                                class="font-semibold text-primary">{{ $arm->teacher->highest_qualification . ' ' . $arm->teacher->specialized_subject }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-slate-600">Years of Service:</span>
                            <span class="font-semibold text-primary">{{ $arm->teacher->years_of_experience }} Years</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-slate-600">Phone:</span>
                            <span class="font-semibold text-primary">{{ $arm->teacher->user->phone }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Email:</span>
                            <span class="font-semibold text-primary">{{ $arm->teacher->user->email }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-slate-500 text-[10px]">Total Students</p>
                            <h2 class="text-2xl font-bold text-primary">35</h2>
                        </div>
                        <div class="bg-blue-100 text-accent p-2 rounded-lg">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-500">Maximum: 40</p>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-slate-500 text-[10px]">Male Students</p>
                            <h2 class="text-2xl font-bold text-primary">18</h2>
                        </div>
                        <div class="bg-blue-100 text-accent p-2 rounded-lg">
                            <i class="fas fa-mars"></i>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-500">51.4% of class</p>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-slate-500 text-[10px]">Female Students</p>
                            <h2 class="text-2xl font-bold text-primary">17</h2>
                        </div>
                        <div class="bg-pink-100 text-pink-600 p-2 rounded-lg">
                            <i class="fas fa-venus"></i>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-500">48.6% of class</p>
                </div>
            </div>

            <!-- Students List -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-slate-200">
                    <h3 class="text-sm font-bold text-primary">Enrolled Students (35)</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-3">S/N</th>
                                <th class="px-6 py-3">Student Name</th>
                                <th class="px-6 py-3">Admission No.</th>
                                <th class="px-6 py-3">Gender</th>
                                <th class="px-6 py-3">Date of Birth</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-3">1</td>
                                <td class="px-6 py-3 font-semibold text-primary">Chimezie Amadi</td>
                                <td class="px-6 py-3">EDP/2024/0001</td>
                                <td class="px-6 py-3">Male</td>
                                <td class="px-6 py-3">15/03/2009</td>
                                <td class="px-6 py-3"><a href="dashboard-show-student.html"
                                        class="text-accent hover:underline text-xs"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-3">2</td>
                                <td class="px-6 py-3 font-semibold text-primary">Blessing Okoro</td>
                                <td class="px-6 py-3">EDP/2024/0002</td>
                                <td class="px-6 py-3">Female</td>
                                <td class="px-6 py-3">22/07/2009</td>
                                <td class="px-6 py-3"><a href="dashboard-show-student.html"
                                        class="text-accent hover:underline text-xs"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-3">3</td>
                                <td class="px-6 py-3 font-semibold text-primary">Chioma Eze</td>
                                <td class="px-6 py-3">EDP/2024/0003</td>
                                <td class="px-6 py-3">Female</td>
                                <td class="px-6 py-3">10/11/2008</td>
                                <td class="px-6 py-3"><a href="dashboard-show-student.html"
                                        class="text-accent hover:underline text-xs"><i class="fas fa-eye"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-3 border-t bg-slate-50 text-slate-600 text-xs">
                    Showing 3 of 35 students. Scroll to view all.
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <a href="{{ route('classes.edit', $arm->class) }}"
                    class="bg-accent text-white px-6 py-2.5 rounded-lg text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
                    <i class="fas fa-edit"></i> Edit Class
                </a>
                <a href="dashboard-delete-class.html"
                    class="bg-red-100 text-red-600 px-6 py-2.5 rounded-lg text-xs font-semibold hover:bg-red-200 transition-all flex items-center gap-2">
                    <i class="fas fa-trash"></i> Delete Class
                </a>
                <x-buttons.gray-back />
            </div>
        </div>
    </main>
@endsection
