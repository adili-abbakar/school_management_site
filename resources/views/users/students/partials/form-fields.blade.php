@php
    $student = $student ?? null;
@endphp

<div class="mb-6">
    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
        <i class="fas fa-user text-accent text-xs"></i>
        Student Information
    </h3>
    <p class="text-xs text-slate-500">Basic details about the student</p>
</div>

@include('users.partials.user-personal-info-fields', ['user' => $student?->user])


<div class="mb-6">
    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
        <i class="fas fa-school text-accent text-xs"></i>
        Enrollment Details
    </h3>
    <p class="text-xs text-slate-500">Class and admission information</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Student ID </label>
        <input type="text" placeholder="e.g., STU001" id="idNumberInput" name="admission_number"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="admission_number"></span>

    </div>
    @if ($student === null)
        <div class="flex items-center gap-2 mt-6">
            <input type="checkbox" name="auto_generate_id" value="1" id="autoGenerateId"
                class="w-4 h-4 text-accent border-slate-300 rounded focus:ring-accent"
                {{ old('auto_generate_id', true) ? 'checked' : '' }}>

            <label for="autoGenerateId" class="text-xs text-slate-600 font-semibold">
                Auto-generate Student ID
            </label>
        </div>
    @endif
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Admission Date *</label>
        <input type="date"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            required>
        <span class="text-red-600 text-[10px] error-message" data-name="admission_number"></span>

    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Academic Session *</label>
        <select
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            required>
            <option value="">Select session</option>
            <option value="2024-2025">2024/2025</option>
            <option value="2025-2026">2025/2026</option>
        </select>
        <span class="text-red-600 text-[10px] error-message" data-name="admission_number"></span>

    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Class/Grade *</label>
        <select
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            required>
            <option value="">Select class</option>
            <option value="jss1">JSS 1</option>
            <option value="jss2">JSS 2</option>
            <option value="jss3">JSS 3</option>
            <option value="ss1">SS 1</option>
            <option value="ss2">SS 2</option>
            <option value="ss3">SS 3</option>
        </select>
        <span class="text-red-600 text-[10px] error-message" data-name="admission_number"></span>

    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Section/Arm</label>
        <select
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <option value="">Select section</option>
            <option value="gold">Gold</option>
            <option value="silver">Silver</option>
            <option value="blue">Blue</option>
            <option value="green">Green</option>
        </select>
        <span class="text-red-600 text-[10px] error-message" data-name="admission_number"></span>

    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Roll Number</label>
        <input type="text" placeholder="Enter roll number"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="admission_number"></span>

    </div>
</div>

<div class="mb-6">
    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
        <i class="fas fa-map-marker-alt text-accent text-xs"></i>
        Address Information
    </h3>
    <p class="text-xs text-slate-500">Residential address details</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <div class="md:col-span-2 lg:col-span-3">
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Residentai Address
            *</label>
        <textarea type="text" placeholder="Enter full home address"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none h-20"></textarea>
    </div>

</div>

<div class="mb-6">
    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
        <i class="fas fa-users text-accent text-xs"></i>
        Guardian Information
    </h3>
    <p class="text-xs text-slate-500">Parent/guardian contact details</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">First Name *</label>
        <input type="text" placeholder="Enter first name"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            required>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Middle Name</label>
        <input type="text" placeholder="Enter middle name"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Last Name
            (Optional)</label>
        <input type="text" placeholder="Enter last name"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            required>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Relationship *</label>
        <select
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            required>
            <option value="">Select relationship</option>
            <option value="father">Father</option>
            <option value="mother">Mother</option>
            <option value="guardian">Legal Guardian</option>
            <option value="other">Other</option>
        </select>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Guardian Phone *</label>
        <input type="tel" placeholder="+1 (555) 000-0000"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            required>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Guardian Email *</label>
        <input type="email" placeholder="guardian@example.com"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            required>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Guardian
            Occupation</label>
        <input type="text" placeholder="Enter occupation"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Alternate Contact</label>
        <input type="tel" placeholder="+1 (555) 000-0000"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
    </div>
</div>

<div class="mb-6">
    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
        <i class="fas fa-file-alt text-accent text-xs"></i>
        Previous School Information
    </h3>
    <p class="text-xs text-slate-500">Details from previous institution (if applicable)</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Previous School
            Name</label>
        <input type="text" placeholder="Enter school name"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Previous
            Class/Grade</label>
        <input type="text" placeholder="Enter previous class"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Year Left</label>
        <input type="number" placeholder="Enter year" min="2000" max="2025"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
    </div>
</div>

<div class="mb-6">
    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
        <i class="fas fa-heartbeat text-accent text-xs"></i>
        Medical & Special Information
    </h3>
    <p class="text-xs text-slate-500">Health and special requirements</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Known Allergies</label>
        <textarea placeholder="Enter any known allergies"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            rows="3"></textarea>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Special
            Needs/Disabilities</label>
        <textarea placeholder="Enter any special needs"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            rows="3"></textarea>
    </div>
</div>
<script src="{{ asset('js/auto-generate-id.js') }}"></script>
