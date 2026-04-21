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
        <textarea type="text" placeholder="Enter full home address" name="address"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none h-20">{{ old('address', $user?->address) }}</textarea>
        <span class="text-red-600 text-[10px] error-message" data-name="address"></span>
    </div>

</div>
