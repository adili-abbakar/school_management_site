@php
    $terms = $terms ?? [];
@endphp
<!-- Terms -->
<div class="repeater-wrapper border-t border-slate-200 pt-6" data-group="terms">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-sm font-bold text-primary">Terms</h3>
        <button type="button"
            class="add-repeater-item-btn bg-accent text-white px-3 py-1.5 rounded text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Term
        </button>

    </div>

    <div class="repeater-container space-y-4">
        @forelse ($terms as $term)
            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 repeater-item">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-4">
                    <input type="hidden" name="terms[{{ $loop->index }}][id]" data-field="id"
                        value="{{ $term->id }}">
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Term Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" placeholder="e.g., First term, Second term ..."
                            name="terms[{{ $loop->index }}][name]" data-field="name"     value="{{ old('name', $term?->name) }}"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                        <span class="text-red-600 text-[10px] error-message" data-field="name"
                            data-name="terms.{{ $loop->index }}.name"></span>

                    </div>

                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Term Start Date <span
                                class="text-red-500">*</span></label>
                        <input type="date" data-field="start_date" name="terms[{{ $loop->index }}][start_date]"   value="{{ old('start_date', $term?->start_date?->format('Y-m-d')) }}"
                            class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                        <span class="text-red-600 text-[10px] error-message" data-field="start_date"
                            data-name="terms.{{ $loop->index }}.start_date"></span>

                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Term End Date <span
                                class="text-red-500">*</span></label>
                        <input type="date" data-field="end_date" name="terms[{{ $loop->index }}][end_date]"  value="{{ old('end_date', $term?->end_date?->format('Y-m-d')) }}"
                            class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                        <span class="text-red-600 text-[10px] error-message" data-field="end_date"
                            data-name="terms.{{ $loop->index }}.end_date"></span>

                    </div>
                </div>
                <button type="button" class="text-red-500 text-xs mt-3 hover:text-red-700 remove-repeater-item-btn">
                    <i class="fas fa-trash mr-1"></i> Remove Term
                </button>
            </div>
        @empty
            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 repeater-item">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-4">
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Term Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" placeholder="e.g., First term, Second term ..." data-field="name"
                            name="terms[0][name]"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                        <span class="text-red-600 text-[10px] error-message" data-field="name"
                            data-name="terms.0.name"></span>

                    </div>

                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Term Start Date <span
                                class="text-red-500">*</span></label>
                        <input type="date" data-field="start_date" name="terms[0][start_date]"
                            class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                        <span class="text-red-600 text-[10px] error-message" data-field="start_date"
                            data-name="terms.0.start_date"></span>

                    </div>
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Term End Date <span
                                class="text-red-500">*</span></label>
                        <input type="date" data-field="end_date" name="terms[0][end_date]"
                            class="w-full px-3 py-1.5 border border-slate-300 rounded text-xs focus:outline-none focus:ring-2 focus:ring-accent bg-white">
                        <span class="text-red-600 text-[10px] error-message" data-field="end_date"
                            data-name="terms.0.end_date"></span>
                    </div>

                </div>
                <button type="button" class="text-red-500 text-xs mt-3 hover:text-red-700 remove-repeater-item-btn">
                    <i class="fas fa-trash mr-1"></i> Remove Term
                </button>
            </div>
        @endforelse
    </div>
</div>

<script src="{{ asset('js/itemRepeater.js') }}"></script>
