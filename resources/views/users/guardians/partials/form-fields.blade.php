@php
    $guardian = $guardian ?? null;
@endphp

<div class="mb-6">
    <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
        <i class="fas fa-user text-accent text-xs"></i>
        Personal Information
    </h3>
    <p class="text-xs text-slate-500">Basic details about the guardian</p>
</div>

@include('users.partials.user-personal-info-fields', ['user' => $guardian?->user])

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

    <div class="md:col-span-2 lg:col-span-3">
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Occupation
            *</label>
        <textarea type="text" placeholder="Enter full occupation" name="occupation"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none h-20">{{ old('occupation', $guardian?->occupation) }}</textarea>
        <span class="text-red-600 text-[10px] error-message" data-name="occupation"></span>
    </div>
</div>

@include('users.partials.address-field', ['user' => $guardian?->user])
<script src="{{ asset('js/auto-generate-staff-id.js') }}"></script>
