@extends('layouts.app')

@section('title', 'Create Class')

@section('page-content')
    <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
        <x-dashboard-header />
        <x-loader-component />


        <div class="p-6">
            <div class="mb-6">
                <x-buttons.blue-back-to-list />
                <h1 class="text-xl font-extrabold text-primary">Create New Class</h1>
                <p class="text-slate-500 text-xs">Add a new class with multiple arms to the system</p>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <form class="space-y-6">
                    <!-- Class Information Section -->
                    <div>
                        <h3 class="text-sm font-bold text-primary mb-4">Class Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-700 mb-2">Class Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" placeholder="e.g., JSS 1"
                                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-700 mb-2">Class Level <span
                                        class="text-red-500">*</span></label>
                                <select
                                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                                    <option>Select Level</option>
                                    <option>JSS 1</option>
                                    <option>JSS 2</option>
                                    <option>JSS 3</option>
                                    <option>SSS 1</option>
                                    <option>SSS 2</option>
                                    <option>SSS 3</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-700 mb-2">Category <span
                                        class="text-red-500">*</span></label>
                                <select
                                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                                    <option>Select Category</option>
                                    <option>Arts</option>
                                    <option>Science</option>
                                    <option>Commercial</option>
                                    <option>General</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Arms Section -->
                    <div class="border-t pt-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-sm font-bold text-primary">Class Arms</h3>
                            <button type="button" id="addArmBtn"
                                class="bg-accent text-white px-3 py-1.5 rounded text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
                                <i class="fas fa-plus"></i> Add Arm
                            </button>
                        </div>

                        <div id="armsContainer" class="space-y-4">
                            <!-- Sample Arm -->
                            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 arm-item">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Arm Name <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" placeholder="e.g., Gold"
                                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Form Teacher
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" placeholder="Enter teacher name"
                                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Max
                                            Students</label>
                                        <input type="number" placeholder="e.g., 40"
                                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                                    </div>
                                </div>
                                <button type="button" class="text-red-500 text-xs mt-3 hover:text-red-700 remove-arm-btn">
                                    <i class="fas fa-trash mr-1"></i> Remove Arm
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-4 pt-6 border-t">
                        <button type="submit"
                            class="bg-accent text-white px-6 py-2.5 rounded-lg text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
                            <i class="fas fa-save"></i> Create Class
                        </button>
                        <a href="dashboard-classes.html"
                            class="bg-slate-200 text-slate-700 px-6 py-2.5 rounded-lg text-xs font-semibold hover:bg-slate-300 transition-all">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Add arm functionality
        const addArmBtn = document.getElementById('addArmBtn');
        const armsContainer = document.getElementById('armsContainer');

        addArmBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const newArm = document.createElement('div');
            newArm.className = 'bg-slate-50 p-4 rounded-lg border border-slate-200 arm-item';
            newArm.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-700 mb-2">Arm Name <span class="text-red-500">*</span></label>
                            <input type="text" placeholder="e.g., Silver" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-700 mb-2">Form Teacher <span class="text-red-500">*</span></label>
                            <input type="text" placeholder="Enter teacher name" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-700 mb-2">Max Students</label>
                            <input type="number" placeholder="e.g., 40" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                        </div>
                    </div>
                    <button type="button" class="text-red-500 text-xs mt-3 hover:text-red-700 remove-arm-btn">
                        <i class="fas fa-trash mr-1"></i> Remove Arm
                    </button>
                `;
            armsContainer.appendChild(newArm);
            attachRemoveListener(newArm.querySelector('.remove-arm-btn'));
        });

        function attachRemoveListener(btn) {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                btn.closest('.arm-item').remove();
            });
        }

        document.querySelectorAll('.remove-arm-btn').forEach(btn => attachRemoveListener(btn));
    </script>
@endsection
