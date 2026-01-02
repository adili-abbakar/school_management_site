@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-content')
    <!-- Main Content -->
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <!-- Header -->
        <x-dashboard-header>
            <div class="flex items-center gap-4 flex-grow max-w-xl">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Search..."
                        class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                </div>
            </div>

        </x-dashboard-header>

        <!-- Dashboard Content -->
        <div class="p-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Dashboard Overview</h1>
                    <p class="text-slate-500 text-xs">Welcome back, Admin. Here's what's happening today.</p>
                </div>
                <div class="flex gap-2">
                    <button
                        class="bg-white border text-primary px-3 py-1.5 rounded-lg text-xs font-semibold shadow-sm hover:bg-slate-50 transition-all flex items-center gap-1.5">
                        <i class="fas fa-download"></i>
                        <span class="hidden sm:inline">Export</span>
                    </button>
                    <button
                        class="bg-accent text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-md hover:bg-blue-600 transition-all flex items-center gap-1.5">
                        <i class="fas fa-plus"></i>
                        <span class="hidden sm:inline">Add Student</span>
                    </button>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-6">
                <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                            <i class="fas fa-user-graduate text-sm"></i>
                        </div>
                        <span class="text-emerald-500 text-[9px] font-bold bg-emerald-50 px-1.5 py-0.5 rounded">+12%</span>
                    </div>
                    <div class="text-2xl font-extrabold text-primary">1,248</div>
                    <div class="text-slate-400 text-[9px] font-semibold uppercase tracking-wider mt-1">Total Students</div>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-1.5 bg-purple-50 text-purple-600 rounded-lg">
                            <i class="fas fa-chalkboard-teacher text-sm"></i>
                        </div>
                        <span class="text-slate-400 text-[9px] font-bold bg-slate-100 px-1.5 py-0.5 rounded">Stable</span>
                    </div>
                    <div class="text-2xl font-extrabold text-primary">84</div>
                    <div class="text-slate-400 text-[9px] font-semibold uppercase tracking-wider mt-1">Total Teachers</div>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-1.5 bg-emerald-50 text-emerald-600 rounded-lg">
                            <i class="fas fa-user-plus text-sm"></i>
                        </div>
                        <span class="text-amber-500 text-[9px] font-bold bg-amber-50 px-1.5 py-0.5 rounded">Pending</span>
                    </div>
                    <div class="text-2xl font-extrabold text-primary">24</div>
                    <div class="text-slate-400 text-[9px] font-semibold uppercase tracking-wider mt-1">New Admissions</div>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-1.5 bg-rose-50 text-rose-600 rounded-lg">
                            <i class="fas fa-file-invoice text-sm"></i>
                        </div>
                        <span class="text-rose-500 text-[9px] font-bold bg-rose-50 px-1.5 py-0.5 rounded">-4%</span>
                    </div>
                    <div class="text-2xl font-extrabold text-primary">92%</div>
                    <div class="text-slate-400 text-[9px] font-semibold uppercase tracking-wider mt-1">Result Published
                    </div>
                </div>
            </div>

            <!-- Main Sections -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Admissions Table -->
                <div class="lg:col-span-2 bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-4 border-b flex justify-between items-center">
                        <h3 class="font-bold text-primary text-sm">Recent Student Admissions</h3>
                        <a href="#" class="text-accent text-[9px] font-bold hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50 text-slate-500 uppercase text-[9px] font-bold tracking-wider">
                                <tr>
                                    <th class="px-4 py-3">Student Name</th>
                                    <th class="px-4 py-3">Class</th>
                                    <th class="px-4 py-3">Reg Date</th>
                                    <th class="px-4 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500 text-[9px]">
                                                JD</div>
                                            <span class="font-semibold text-primary">John Doe</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-slate-600 font-medium">JSS 1</td>
                                    <td class="px-4 py-3 text-slate-500">Oct 12</td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded-full text-[8px] font-bold uppercase">Approved</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500 text-[9px]">
                                                AS</div>
                                            <span class="font-semibold text-primary">Alice Smith</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-slate-600 font-medium">SS 2</td>
                                    <td class="px-4 py-3 text-slate-500">Oct 11</td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded-full text-[8px] font-bold uppercase">Pending</span>
                                    </td>
                                </tr>
                                @for ($i = 0; $i <= 5; $i++)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-500 text-[9px]">
                                                    MB</div>
                                                <span class="font-semibold text-primary">Mark Brown</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600 font-medium">JSS 3</td>
                                        <td class="px-4 py-3 text-slate-500">Oct 10</td>
                                        <td class="px-4 py-3 text-center">
                                            <span
                                                class="bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded-full text-[8px] font-bold uppercase">Approved</span>
                                        </td>

                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Notifications/Events -->
                <div class="space-y-4">
                    <div class="bg-white rounded-xl border border-slate-100 shadow-sm p-4">
                        <h3 class="font-bold text-primary mb-3 flex items-center justify-between text-sm">
                            <span>Upcoming Events</span>
                            <i class="fas fa-calendar-day text-slate-300 text-xs"></i>
                        </h3>
                        <div class="space-y-3">
                            <div class="flex gap-3 p-2 bg-slate-50 rounded-lg">
                                <div
                                    class="text-center bg-white px-1.5 py-1 rounded-md shadow-sm border border-slate-100 h-fit">
                                    <div class="text-[8px] font-bold text-slate-400 uppercase leading-none">Oct</div>
                                    <div class="text-sm font-extrabold text-primary">24</div>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-primary leading-tight">Inter-house Sports</div>
                                    <div class="text-[9px] text-slate-500 mt-0.5">Stadium • 09:00 AM</div>
                                </div>
                            </div>
                            <div class="flex gap-3 p-2 bg-slate-50 rounded-lg">
                                <div
                                    class="text-center bg-white px-1.5 py-1 rounded-md shadow-sm border border-slate-100 h-fit">
                                    <div class="text-[8px] font-bold text-slate-400 uppercase leading-none">Nov</div>
                                    <div class="text-sm font-extrabold text-primary">02</div>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-primary leading-tight">Staff Meeting</div>
                                    <div class="text-[9px] text-slate-500 mt-0.5">Hall • 10:00 AM</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-primary to-slate-800 rounded-xl p-4 text-white shadow-lg shadow-primary/20">
                        <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center mb-3">
                            <i class="fas fa-shield-halved text-accent text-xs"></i>
                        </div>
                        <h4 class="font-bold mb-1.5 text-xs">System Security</h4>
                        <p class="text-[9px] text-slate-400 mb-3 leading-relaxed">Last backup completed 2 hours ago.
                            Everything is running smoothly.</p>
                        <button class="text-[9px] font-bold text-accent hover:underline">View Logs →</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
