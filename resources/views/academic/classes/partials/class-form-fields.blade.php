@php
    $class = $class ?? null;
    $classes = $classes ?? null;
@endphp
<!-- Class Information Program -->
<div>
    <h3 class="text-sm font-bold text-primary mb-4">Class Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div>
            <label class="block text-[10px] font-semibold text-slate-700 mb-2">Class Name <span
                    class="text-red-500">*</span></label>
            <input type="text" placeholder="e.g., JSS 1" name="class_name" value="{{ $class?->name ?? '' }}"
                class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="class_name"></span>
        </div>
        <div>
            <label class="block text-[10px] font-semibold text-slate-700 mb-2 flex gap-3">
                <span>
                    <span>Program</span>
                    <span class="text-red-500">*</span>
                </span>
                <a href="{{ route('programs.create') }}" class="text-[12px]  underline text-accent hover:font-light">
                    Add new Program
                </a>
            </label>
            <select name="class_program" id="program_id" data-target="level_id" data-route="/programs/{id}/levels"
                data-placeholder="Select program"
                class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                <option value="{{ null }}" selected disabled>Select Program</option>
                @forelse ($programs as $program)
                    <option value="{{ $program->id }}" @selected(old('class_program', $class->program_id ?? '') == $program->id)>
                        {{ $program->name }}
                    </option>
                @empty
                    <option>
                        <span>No program found.</span>
                    </option>
                @endforelse
            </select>
            <span class="text-red-600 text-[10px] error-message" data-name="class_level"></span>
        </div>
        <div>
            <label class="block text-[10px] font-semibold text-slate-700 mb-2 flex gap-3">
                <span>
                    <span>Class Level</span>
                    <span class="text-red-500">*</span>
                </span>
                <a href="{{ route('programs.index') }}" class="text-[12px]  underline  text-accent hover:font-light">
                    Add new level
                </a>
            </label>
            <select name="class_level" id="level_id";
                class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none disabled:cursor-not-allowed disabled:text-slate-400 disabled:bg-slate-50"
                disabled data-selected="{{ old('class_level', $class?->class_level_id ?? '') }}">
                <option class="text-slate-200" selected disabled>Select program first</option>
            </select>
            <span class="text-red-600 text-[10px] error-message" data-name="class_level"></span>
        </div>
        <div>
            <label class="block text-[10px] font-semibold text-slate-700 mb-2">Previous Class</label>
            <select name="previous_class_id"
                class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                <option value="">Select Previous Class</option>
                @forelse ($classes as $classItem)
                    <option value="{{ $classItem->id }}"
                        {{ $class?->previousClass?->id === $classItem->id ? 'selected' : '' }}>{{ $classItem->name }}
                    </option>
                @empty
                    <option>No classes yet — create one first</option>
                @endforelse
            </select>
            <span class="text-red-600 text-[10px] error-message" data-name="previous_class_id"></span>
        </div>
    </div>
    <br>
    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4">
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
        <div id="confirmModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-5">
                <h3 class="text-sm font-semibold mb-2">Confirm overwrite</h3>
                <p class="text-sm text-slate-600 mb-4">
                    Another class already points to the selected next class. Overwriting will remove
                    that link.
                    Are you sure you want to continue?
                </p>
                <div class="flex justify-end gap-2">
                    <button id="cancelConfirm" type="button" class="px-3 py-1 border rounded text-sm">Cancel</button>
                    <button id="confirmSubmit" type="button"
                        class="px-3 py-1 bg-red-600 text-white rounded text-sm">Yes, overwrite</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('js/auto-select.js') }}"></script>
