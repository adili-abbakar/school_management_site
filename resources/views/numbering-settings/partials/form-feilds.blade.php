@php
    $setting = $setting ?? null;
@endphp

<!-- Section Title -->
<div class="mb-6">
    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
        <i class="fas fa-hashtag text-accent text-xs"></i>
        Numbering Configuration
    </h3>
    <p class="text-xs text-slate-500">Configure pattern for generated numbers</p>
</div>

<!-- Fields -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

    <!-- Type -->
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">
            Type *
        </label>
        <select name="type"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <option value="">Select type</option>

            <option value="admission_number" {{ old('type', $setting?->type) === 'admission_number' ? 'selected' : '' }}>
                Admission Number
            </option>

            <option value="staff_id" {{ old('type', $setting?->type) === 'staff_id' ? 'selected' : '' }}>
                Staff ID
            </option>

            <option value="application_number"
                {{ old('type', $setting?->type) === 'application_number' ? 'selected' : '' }}>
                Application Number
            </option>
        </select>
        <span class="text-red-600 text-[10px] error-message" data-name="type"></span>
    </div>

    <!-- Prefix -->
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">
            Prefix
        </label>
        <input type="text" name="prefix" placeholder="e.g ADM"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            value="{{ old('prefix', $setting?->prefix) }}">
        <span class="text-red-600 text-[10px] error-message" data-name="prefix"></span>
    </div>

    <!-- Separator -->
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">
            Separator
        </label>
        <input type="text" name="separator"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            value="{{ old('separator', $setting?->separator) }}">
        <span class="text-red-600 text-[10px]
            error-message" data-name="separator"></span>
    </div>

    <!-- Padding -->
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">
            Padding *
        </label>
        <input type="number" name="padding" placeholder="e.g 4"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            value="{{ old('padding', $setting?->padding ?? 4) }}">
        <span class="text-red-600 text-[10px]
            error-message" data-name="padding"></span>
    </div>

    <!-- Next Number -->
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">
            Next Number *
        </label>
        <input type="number" name="next_number"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            value="{{ old('next_number', $setting?->next_number ?? 1) }}">
        <span class="text-red-600 text-[10px]
            error-message" data-name="next_number"></span>
    </div>

    <!-- Include Year -->
    <div class="flex items-center gap-2 mt-6">
        <input type="checkbox" name="include_year" value="1"
            class="w-4 h-4 text-accent border-slate-300 rounded focus:ring-accent"
            {{ old('include_year', $setting?->include_year) ? 'checked' : '' }}>
        <label class="text-xs text-slate-600 font-semibold">
            Include Year
        </label>
    </div>

</div>
