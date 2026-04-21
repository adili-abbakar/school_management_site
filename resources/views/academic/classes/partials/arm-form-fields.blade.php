@php
    $term = $term ?? [];
    $teachers = $teachers ?? [];
    $arms = $arms ?? [];
@endphp
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
        @forelse ($arms as $arm)
            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 arm-item">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Arm Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" placeholder="e.g., Gold" name="arms[{{ $loop->index }}][name]"
                            value="{{ $arm->name }}"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                        <span class="text-red-600 text-[10px] error-message"
                            data-name="arms.{{ $loop->index }}.name"></span>

                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Form Teacher
                            <span class="text-red-500">*</span></label>
                        <select type="text" placeholder="Enter teacher name"
                            name="arms[{{ $loop->index }}][form_teacher]"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                            <option value="{{ null }}">Select teacher</option>
                            @forelse ($teachers as $teacher)
                                <option value="{{ $teacher->user_id }}"
                                    {{ $arm->teacher_id === $teacher->user_id ? 'selected' : '' }}>
                                    {{ $teacher->user->full_name }}</option>
                            @empty
                                <option value="{{ null }}">No teachers yet — create one first</option>
                            @endforelse
                        </select>
                        <span class="text-red-600 text-[10px] error-message"
                            data-name="arms.{{ $loop->index }}.form_teacher"></span>
                    </div>

                </div>
                <button type="button" class="text-red-500 text-xs mt-3 hover:text-red-700 remove-arm-btn">
                    <i class="fas fa-trash mr-1"></i> Remove Arm
                </button>
            </div>
        @empty
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
                                <option value="{{ $teacher->user_id }}">{{ $teacher->user->full_name }}</option>
                            @empty
                                <option value="{{ null }}">No teachers yet — create one first</option>
                            @endforelse
                        </select>
                        <span class="text-red-600 text-[10px] error-message" data-name="arms.0.form_teacher"></span>
                    </div>

                </div>
                <button type="button" class="text-red-500 text-xs mt-3 hover:text-red-700 remove-arm-btn">
                    <i class="fas fa-trash mr-1"></i> Remove Arm
                </button>
            </div>
        @endforelse
    </div>
</div>

<script src="{{ asset('js/class-form.js') }}"></script>
