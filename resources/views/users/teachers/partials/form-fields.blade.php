@php
    $teacher = $teacher ?? null;
@endphp

@include('users.partials.user-personal-info-fields', ['user' => $teacher?->user])

<div class="mb-6">
    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
        <i class="fas fa-graduation-cap text-accent text-xs"></i>
        Professional Information
    </h3>
    <p class="text-xs text-slate-500">Teaching qualifications and experience</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">
            Staff ID Number *
        </label>

        <input type="text" placeholder="e.g., STF/2026/001" name="staff_number" id="staffNumberInput"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            value="{{ old('staff_number', $teacher?->staff?->staff_number) }}">

        <span class="text-red-600 text-[10px] error-message" data-name="staff_number"></span>
    </div>

    @if ($teacher === null)
        <div class="flex items-center gap-2 mt-6">
            <input type="checkbox" name="auto_generate_staff_id" value="1" id="autoGenerateStaffId"
                class="w-4 h-4 text-accent border-slate-300 rounded focus:ring-accent"
                {{ old('auto_generate_staff_id', true) ? 'checked' : '' }}>

            <label for="autoGenerateStaffId" class="text-xs text-slate-600 font-semibold">
                Auto-generate Staff ID
            </label>
        </div>
    @endif
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Highest Qualification
            *</label>
        <input name="highest_qualification" type="text" placeholder="Enter Qualification"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            value="{{ old('highest_qualification', $teacher?->highest_qualification) }}">
        <span class="text-red-600 text-[10px] error-message" data-name="highest_qualification"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Specialized Subject</label>
        <input type="text" placeholder="Enter subject" min="0" name="specialized_subject"
            value="{{ old('specialized_subject', $teacher?->specialized_subject) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="specialized_subject"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Years of
            Experience</label>
        <input type="number" placeholder="Enter years" min="0" name="years_of_experience"
            value="{{ old('years_of_experience', $teacher?->years_of_experience) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="years_of_experience"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Employment Type *</label>
        <select name="employment_type"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <option value="">Select type</option>

            <option value="full_time"
                {{ old('employment_type', $teacher?->employment_type) === 'full_time' ? 'selected' : '' }}>
                Full Time
            </option>

            <option value="part_time"
                {{ old('employment_type', $teacher?->employment_type) === 'part_time' ? 'selected' : '' }}>
                Part Time
            </option>

            <option value="contract"
                {{ old('employment_type', $teacher?->employment_type) === 'contract' ? 'selected' : '' }}>
                Contract
            </option>
        </select>
        <span class="text-red-600 text-[10px] error-message" data-name="employment_type"></span>
    </div>



    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Date of Joining *</label>
        <input type="date" name="start_date" value="{{ old('start_date', $teacher?->start_date) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="start_date"></span>
    </div>
</div>

@include('users.partials.address-field', ['user' => $teacher?->user])
<script src="{{ asset('js/auto-generate-staff-id.js') }}"></script>
