@php
    $program = $program ?? null;
    $level = $level ?? null;
@endphp

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-primary font-semibold text-lg mb-1">{{ $program->name }} Academic Program</h2>
        <div class="flex flex-col md:flex-row gap-4 text-xs text-muted mt-2">
            <div class="flex items-top gap-1.5">
                <i class="fas fa-info-circle text-accent" style="padding-top: 0.5px"></i>
                <span>Description: {{ $program->description }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Divider -->
<div class="border-t border-slate-200 pt-4"></div>

<!-- levels -->
<div>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-semibold text-primary">Levels</h3>
    </div>

    <!-- Levels Container -->
    <div id="levelsContainer" class="space-y-4">
        <div class="level-block bg-slate-50 p-4 rounded border border-slate-200">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Level Name <span
                            class="text-red-500">*</span></label></label>
                    <input type="text" name="name" placeholder="First Level"
                        value="{{ old('name', $level?->name) }}"
                        class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                    <span class="text-red-600 text-[10px] error-message" data-name="name"></span>

                </div>
                <div>
                    <label class="block text-[10px] font-semibold text-slate-700 mb-2">Level Description <span
                            class="text-red-500">*</span></label>
                    <textarea type="text" placeholder="e.g., Describe the level" name="description"
                        data-field="description"
                        class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">{{ old('name', $level?->description) }}</textarea>
                    <span class="text-red-600 text-[10px] error-message" data-field="description"
                        data-name="description"></span>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Divider -->
<div class="border-t border-slate-200 pt-4"></div>

<!-- Form Actions -->
<div class="flex gap-3 justify-end">
    <x-buttons.transparent-cancel />
    <x-buttons.light-blue-submit />
</div>
