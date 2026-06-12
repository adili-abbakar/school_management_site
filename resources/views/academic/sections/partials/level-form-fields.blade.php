@php
    $levels = $levels ?? [];
@endphp
<!-- Arms Section -->
<div class="repeater-wrapper border-t border-slate-200 pt-6" data-group="levels">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-sm font-bold text-primary">Section Levels</h3>
        <button type="button"
            class="add-repeater-item-btn bg-accent text-white px-3 py-1.5 rounded text-xs font-semibold hover:bg-blue-600 transition-all flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Level
        </button>

    </div>

    <div class="repeater-container space-y-4">
        @forelse ($levels as $level)
            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 repeater-item">
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2  gap-4">
                    <input type="hidden" name="levels[{{ $loop->index }}][id]" data-field="id"  value="{{ $level->id }}">
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Level Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" placeholder="e.g., Primary, Nursery"
                            name="levels[{{ $loop->index }}][name]" data-field="name" value="{{ $level->name }}"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                        <span class="text-red-600 text-[10px] error-message" data-field="name"
                            data-name="levels.{{ $loop->index }}.name"></span>

                    </div>

                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Level Description <span
                                class="text-red-500">*</span></label>
                        <textarea type="text" placeholder="e.g., Describe the level" name="levels[{{ $loop->index }}][description]"
                            data-field="description"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">{{ $level->description }}</textarea>
                        <span class="text-red-600 text-[10px] error-message" data-field="description"
                            data-name="levels.{{ $loop->index }}.description"></span>

                    </div>
                </div>
                <button type="button" class="text-red-500 text-xs mt-3 hover:text-red-700 remove-repeater-item-btn">
                    <i class="fas fa-trash mr-1"></i> Remove Level
                </button>
            </div>
        @empty
            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200 repeater-item">
                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2  gap-4">
                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Arm Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" placeholder="e.g., Primary, Nursery" data-field="name"
                            name="levels[0][name]"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none">
                        <span class="text-red-600 text-[10px] error-message" data-field="name"
                            data-name="levels.0.name"></span>

                    </div>

                    <div>
                        <label class="block text-[10px] font-semibold text-slate-700 mb-2">Level Description <span
                                class="text-red-500">*</span></label>
                        <textarea type="text" placeholder="e.g., Describe the level" name="levels[0][description]" data-field="description"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-accent focus:border-transparent outline-none"></textarea>
                        <span class="text-red-600 text-[10px] error-message" data-field="description"
                            data-name="levels.0.description"></span>

                    </div>

                </div>
                <button type="button" class="text-red-500 text-xs mt-3 hover:text-red-700 remove-repeater-item-btn">
                    <i class="fas fa-trash mr-1"></i> Remove Level
                </button>
            </div>
        @endforelse
    </div>
</div>

<script src="{{ asset('js/itemRepeater.js') }}"></script>
