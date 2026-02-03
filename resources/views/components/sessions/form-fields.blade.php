@props(['session' => null])

<div>
    <h3 class="text-sm font-semibold text-primary mb-4">Session Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Session Name</label>
            <input type="text" placeholder="e.g., 2023/2024" name="session_name" value="{{ old('session_name', $session?->name) }}"
                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent">
            <span class="text-red-600 text-[10px] error-message" data-name="session_name"></span>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Session Start
                Date</label>
            <input type="date" name="session_start_date"  value="{{ old('session_start_date', $session?->start_date?->format('Y-m-d')) }}"
                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent">
            <span class="text-red-600 text-[10px] error-message" data-name="session_start_date"></span>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Session End
                Date</label>
            <input type="date" name="session_end_date"  value="{{ old('session_end_date', $session?->end_date?->format('Y-m-d')) }}"
                class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent">
            <span class="text-red-600 text-[10px] error-message" data-name="session_end_date"></span>
        </div>
    </div>
</div>
