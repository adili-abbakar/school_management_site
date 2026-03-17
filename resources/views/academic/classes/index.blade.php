@extends('layouts.app')

@section('title', 'Class management')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header>
            <div class="flex items-center gap-4 flex-grow max-w-xl">
                <div class="relative w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Search classes..."
                        class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
                </div>
            </div>
        </x-dashboard-header>
        <x-loader-component />

        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-xl font-extrabold text-primary">Class Management</h1>
                    <p class="text-slate-500 text-xs">Define classes, arms, and assign form teachers.</p>
                </div>
                <a href="{{ route('classes.create') }}"
                    class="bg-accent text-white px-4 py-2 rounded-lg text-xs font-semibold shadow hover:bg-blue-600 transition-all flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Add New Class</span>
                </a>
            </div>

            <!-- Classes List with Collapsible Arms -->
            <div class="space-y-3 mb-8">
                <!-- JSS 1 Class -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                    <button onclick="toggleArms(this)"
                        class="w-full px-5 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors text-left">
                        <div class="flex items-center gap-4 flex-grow">
                            <i class="fas fa-chevron-down text-accent transition-transform duration-300"></i>
                            <div class="flex-grow">
                                <h3 class="font-bold text-primary text-sm">JSS 1</h3>
                                <p class="text-slate-500 text-xs">Junior Secondary School</p>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-slate-600">
                                <span><i class="fas fa-users text-accent mr-1"></i>105 Students</span>
                                <span><i class="fas fa-chalkboard-teacher text-accent mr-1"></i>3 Teachers</span>
                                <span class="bg-blue-100 text-accent px-2 py-0.5 rounded">3 Arms</span>
                            </div>
                        </div>
                    </button>

                    <!-- Arms Container -->
                    <div class="arms-container hidden border-t bg-slate-50">
                        <div class="p-4 space-y-2">
                            <div
                                class="flex items-center justify-between bg-white p-3 rounded-lg border border-slate-100 text-xs">
                                <div class="flex-grow">
                                    <p class="font-semibold text-primary">JSS 1 Gold</p>
                                    <p class="text-slate-500 text-[10px]">35 Students • Teacher: Prof. Alan Turing</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="dashboard-show-class.html" class="text-accent hover:text-blue-700"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="dashboard-edit-class.html" class="text-blue-500 hover:text-blue-700"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between bg-white p-3 rounded-lg border border-slate-100 text-xs">
                                <div class="flex-grow">
                                    <p class="font-semibold text-primary">JSS 1 Silver</p>
                                    <p class="text-slate-500 text-[10px]">35 Students • Teacher: Dr. Grace Lee</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="dashboard-show-class.html" class="text-accent hover:text-blue-700"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="dashboard-edit-class.html" class="text-blue-500 hover:text-blue-700"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between bg-white p-3 rounded-lg border border-slate-100 text-xs">
                                <div class="flex-grow">
                                    <p class="font-semibold text-primary">JSS 1 Bronze</p>
                                    <p class="text-slate-500 text-[10px]">35 Students • Teacher: Mr. James Smith</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="dashboard-show-class.html" class="text-accent hover:text-blue-700"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="dashboard-edit-class.html" class="text-blue-500 hover:text-blue-700"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 px-4 pb-4 text-xs">
                            <a href="dashboard-edit-class.html"
                                class="flex-1 bg-blue-50 text-accent px-3 py-2 rounded hover:bg-blue-100 transition text-center font-semibold"><i
                                    class="fas fa-edit mr-1"></i>Edit Class</a>
                            <a href="dashboard-delete-class.html"
                                class="flex-1 bg-red-50 text-red-500 px-3 py-2 rounded hover:bg-red-100 transition text-center font-semibold"><i
                                    class="fas fa-trash mr-1"></i>Delete</a>
                        </div>
                    </div>
                </div>

                <!-- JSS 2 Class -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                    <button onclick="toggleArms(this)"
                        class="w-full px-5 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors text-left">
                        <div class="flex items-center gap-4 flex-grow">
                            <i class="fas fa-chevron-down text-accent transition-transform duration-300"></i>
                            <div class="flex-grow">
                                <h3 class="font-bold text-primary text-sm">JSS 2</h3>
                                <p class="text-slate-500 text-xs">Junior Secondary School</p>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-slate-600">
                                <span><i class="fas fa-users text-accent mr-1"></i>102 Students</span>
                                <span><i class="fas fa-chalkboard-teacher text-accent mr-1"></i>3 Teachers</span>
                                <span class="bg-blue-100 text-accent px-2 py-0.5 rounded">3 Arms</span>
                            </div>
                        </div>
                    </button>

                    <!-- Arms Container -->
                    <div class="arms-container hidden border-t bg-slate-50">
                        <div class="p-4 space-y-2">
                            <div
                                class="flex items-center justify-between bg-white p-3 rounded-lg border border-slate-100 text-xs">
                                <div class="flex-grow">
                                    <p class="font-semibold text-primary">JSS 2 Gold</p>
                                    <p class="text-slate-500 text-[10px]">34 Students • Teacher: Prof. Sarah Johnson</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="dashboard-show-class.html" class="text-accent hover:text-blue-700"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="dashboard-edit-class.html" class="text-blue-500 hover:text-blue-700"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between bg-white p-3 rounded-lg border border-slate-100 text-xs">
                                <div class="flex-grow">
                                    <p class="font-semibold text-primary">JSS 2 Silver</p>
                                    <p class="text-slate-500 text-[10px]">34 Students • Teacher: Mrs. Emily Brown</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="dashboard-show-class.html" class="text-accent hover:text-blue-700"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="dashboard-edit-class.html" class="text-blue-500 hover:text-blue-700"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between bg-white p-3 rounded-lg border border-slate-100 text-xs">
                                <div class="flex-grow">
                                    <p class="font-semibold text-primary">JSS 2 Bronze</p>
                                    <p class="text-slate-500 text-[10px]">34 Students • Teacher: Mr. David Wilson</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="dashboard-show-class.html" class="text-accent hover:text-blue-700"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="dashboard-edit-class.html" class="text-blue-500 hover:text-blue-700"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 px-4 pb-4 text-xs">
                            <a href="dashboard-edit-class.html"
                                class="flex-1 bg-blue-50 text-accent px-3 py-2 rounded hover:bg-blue-100 transition text-center font-semibold"><i
                                    class="fas fa-edit mr-1"></i>Edit Class</a>
                            <a href="dashboard-delete-class.html"
                                class="flex-1 bg-red-50 text-red-500 px-3 py-2 rounded hover:bg-red-100 transition text-center font-semibold"><i
                                    class="fas fa-trash mr-1"></i>Delete</a>
                        </div>
                    </div>
                </div>

                <!-- JSS 3 Class -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                    <button onclick="toggleArms(this)"
                        class="w-full px-5 py-4 flex items-center justify-between hover:bg-slate-50 transition-colors text-left">
                        <div class="flex items-center gap-4 flex-grow">
                            <i class="fas fa-chevron-down text-accent transition-transform duration-300"></i>
                            <div class="flex-grow">
                                <h3 class="font-bold text-primary text-sm">JSS 3</h3>
                                <p class="text-slate-500 text-xs">Junior Secondary School</p>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-slate-600">
                                <span><i class="fas fa-users text-accent mr-1"></i>98 Students</span>
                                <span><i class="fas fa-chalkboard-teacher text-accent mr-1"></i>3 Teachers</span>
                                <span class="bg-blue-100 text-accent px-2 py-0.5 rounded">3 Arms</span>
                            </div>
                        </div>
                    </button>

                    <!-- Arms Container -->
                    <div class="arms-container hidden border-t bg-slate-50">
                        <div class="p-4 space-y-2">
                            <div
                                class="flex items-center justify-between bg-white p-3 rounded-lg border border-slate-100 text-xs">
                                <div class="flex-grow">
                                    <p class="font-semibold text-primary">JSS 3 Gold</p>
                                    <p class="text-slate-500 text-[10px]">33 Students • Teacher: Prof. Michael Chen</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="dashboard-show-class.html" class="text-accent hover:text-blue-700"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="dashboard-edit-class.html" class="text-blue-500 hover:text-blue-700"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between bg-white p-3 rounded-lg border border-slate-100 text-xs">
                                <div class="flex-grow">
                                    <p class="font-semibold text-primary">JSS 3 Silver</p>
                                    <p class="text-slate-500 text-[10px]">32 Students • Teacher: Dr. Lisa Anderson</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="dashboard-show-class.html" class="text-accent hover:text-blue-700"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="dashboard-edit-class.html" class="text-blue-500 hover:text-blue-700"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between bg-white p-3 rounded-lg border border-slate-100 text-xs">
                                <div class="flex-grow">
                                    <p class="font-semibold text-primary">JSS 3 Bronze</p>
                                    <p class="text-slate-500 text-[10px]">33 Students • Teacher: Mr. Robert King</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="dashboard-show-class.html" class="text-accent hover:text-blue-700"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="dashboard-edit-class.html" class="text-blue-500 hover:text-blue-700"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 px-4 pb-4 text-xs">
                            <a href="dashboard-edit-class.html"
                                class="flex-1 bg-blue-50 text-accent px-3 py-2 rounded hover:bg-blue-100 transition text-center font-semibold"><i
                                    class="fas fa-edit mr-1"></i>Edit Class</a>
                            <a href="dashboard-delete-class.html"
                                class="flex-1 bg-red-50 text-red-500 px-3 py-2 rounded hover:bg-red-100 transition text-center font-semibold"><i
                                    class="fas fa-trash mr-1"></i>Delete</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </main>
    <script>
        function toggleArms(button) {
            const container = button.nextElementSibling;
            const icon = button.querySelector('i.fa-chevron-down');

            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                container.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
@endsection
