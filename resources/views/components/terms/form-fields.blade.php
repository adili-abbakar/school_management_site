@props(['session' => null, 'term' => null])

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-primary font-semibold text-lg mb-1">Academic Session
            {{ $session->name }}</h2>
        <div class="flex flex-col md:flex-row gap-4 text-xs text-muted mt-2">
            <div class="flex items-center gap-1.5">
                <i class="fas fa-calendar text-accent"></i>
                <span>Starts: <strong>{{ $session->startDate() }}</strong></span>
            </div>
            <div class="flex items-center gap-1.5">
                <i class="fas fa-calendar text-accent"></i>
                <span>Ends: <strong>{{ $session->endDate() }}</strong></span>
            </div>
        </div>
    </div>
</div>

<!-- Divider -->
<div class="border-t border-slate-200 pt-4"></div>

<!-- Terms -->
<div>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-semibold text-primary">Terms</h3>
    </div>

    <!-- Terms Container -->
    <div id="termsContainer" class="space-y-4">
        <div class="term-block bg-slate-50 p-4 rounded border border-slate-200">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Term Name</label>
                    <input type="text" name="name" placeholder="First Term" value="{{ old('name', $term?->name) }}"
                        class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                    <span class="text-red-600 text-[10px] error-message" data-name="name"></span>

                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Start
                        Date</label>
                    <input type="date" name="start_date"  value="{{ old('start_date', $term?->start_date?->format('Y-m-d')) }}"
                        class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                    <span class="text-red-600 text-[10px] error-message" data-name="start_date"></span>

                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">End Date</label>
                    <input type="date" name="end_date"  value="{{ old('end_date', $term?->end_date?->format('Y-m-d')) }}"
                        class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                    <span class="text-red-600 text-[10px] error-message" data-name="end_date"></span>

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
