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

            <form class="form space-y-6" action="{{ route('classes.store') }}" method="POST">
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                    @csrf
                    <!-- Class Information Section -->
                    <div>
                        <h3 class="text-sm font-bold text-primary mb-4">Class Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-700 mb-2">Class Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" placeholder="e.g., JSS 1" name="class_name"
                                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                                <span class="text-red-600 text-[10px] error-message" data-name="class_name"></span>
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-700 mb-2">Class Level <span
                                        class="text-red-500">*</span></label>
                                <select name="class_level"
                                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                                    <option>Select Level</option>
                                    <option value="nursery">Nursery</option>
                                    <option value="primary">Primary</option>
                                    <option value="jss">Junior Secondary (JSS)</option>
                                    <option value="sss">Senior Secondary (SS)</option>
                                </select>
                                <span class="text-red-600 text-[10px] error-message" data-name="class_level"></span>
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-700 mb-2">Previous Class</label>
                                <select name="previous_class_id"
                                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                                    <option value="{{ null }}">Select Previous Class</option>
                                    @forelse ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @empty
                                        <option>No classes yet — create one first</option>
                                    @endforelse
                                </select>
                                <span class="text-red-600 text-[10px] error-message" data-name="previous_class_id"></span>
                            </div>
                            <div class="flex items-center gap-3">
                                <!-- ensure a value is always sent -->
                                <input type="hidden" name="force_overwrite" value="0">

                                <input id="force_overwrite" name="force_overwrite" type="checkbox" value="1"
                                    class="h-4 w-4 text-accent border-slate-300 rounded focus:ring-2 focus:ring-accent" />

                                <label for="force_overwrite" class="text-xs font-semibold text-slate-700">
                                    Overwrite existing link if any
                                </label>

                                <p class="text-xs text-slate-500 ml-2">Check to allow replacing an existing next pointer.
                                </p>
                            </div>
                            <div id="confirmModal"
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden">
                                <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-5">
                                    <h3 class="text-sm font-semibold mb-2">Confirm overwrite</h3>
                                    <p class="text-sm text-slate-600 mb-4">
                                        Another class already points to the selected next class. Overwriting will remove
                                        that link.
                                        Are you sure you want to continue?
                                    </p>
                                    <div class="flex justify-end gap-2">
                                        <button id="cancelConfirm" type="button"
                                            class="px-3 py-1 border rounded text-sm">Cancel</button>
                                        <button id="confirmSubmit" type="button"
                                            class="px-3 py-1 bg-red-600 text-white rounded text-sm">Yes, overwrite</button>
                                    </div>
                                </div>
                            </div>
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
                        <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 arm-item">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-semibold text-slate-700 mb-2">Arm Name <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" placeholder="e.g., Gold" name="arms[0][name]"
                                        class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                                    <span class="text-red-600 text-[10px] error-message" data-name="arms.0.name"></span>

                                </div>
                                <div>
                                    <label class="block text-[10px] font-semibold text-slate-700 mb-2">Form Teacher
                                        <span class="text-red-500">*</span></label>
                                    <select type="text" placeholder="Enter teacher name" name="arms[0][form_teacher]"
                                        class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                                        <option value="{{ null }}">Select teacher</option>
                                        @forelse ($teachers as $teacher)
                                            <option value="{{ $teacher->user_id }}">{{ $teacher->user->name() }}</option>
                                        @empty
                                            <option value="{{ null }}">No teachers yet — create one first</option>
                                        @endforelse
                                    </select>
                                    <span class="text-red-600 text-[10px] error-message"
                                        data-name="arms.0.form_teacher"></span>
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

    <script src="{{ asset('js/class-overider.js') }}"></script>
    <script src="{{ asset('js/class-form.js') }}"></script>
    <script src="{{ asset('/js/formSubmitter.js') }}"></script>
@endsection
