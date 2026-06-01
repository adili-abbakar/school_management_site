@php
    $seciton = $section ?? null;
    $sections = $sections ?? null;
@endphp
<!-- Section Information Section -->
<div>
    <h3 class="text-sm font-bold text-primary mb-4">Section Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-4">
        <div>
            <label class="block text-[10px] font-semibold text-slate-700 mb-2">Section Name <span
                    class="text-red-500">*</span></label>
            <input type="text" placeholder="e.g., General Studies, tahfeez" name="section_name" value="{{ $section?->name ?? '' }}"
                class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="section_name"></span>
        </div>
       
       <div>
            <label class="block text-[10px] font-semibold text-slate-700 mb-2">Section Description<span
                    class="text-red-500">*</span></label>
            <textarea type="text" placeholder="e.g section purpose" name="section_description" value="{{ $section?->name ?? '' }}"
                class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">{{ $section?->description ?? '' }}</textarea>
            <span class="text-red-600 text-[10px] error-message" data-name="section_description"></span>
        </div>
    </div>

</div>
