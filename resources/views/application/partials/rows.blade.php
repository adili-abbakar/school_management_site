@forelse ($applications as $app)
    <div data-status="{{ $app->status }}"
        class="admission-applications bg-white rounded-lg border border-slate-100 p-4 shadow-sm hover:shadow-md transition-all border-l-4
                @switch($app->status)
                    @case('pending') border-l-amber-400 @break
                    @case('approved') border-l-green-400 @break
                    @case('withdrawn') border-l-gray-400 @break
                    @case('rejected') border-l-red-400 @break
                @endswitch">

        <div class="flex flex-col xl:flex-row xl:items-start xl:justify-between gap-4">

            <div class="flex gap-3 min-w-0 flex-1">
                <div
                    class="w-12 h-12 shrink-0 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 text-sm font-bold">
                    SB
                </div>

                <div class="min-w-0 flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 mb-1">
                        <h3 class="text-sm font-bold text-primary break-words">
                            {{ $app->student_name }}
                        </h3>

                        <span
                            class="status-badge w-fit
                                    @switch($app->status)
                                        @case('pending') status-pending @break
                                        @case('approved') status-approved @break
                                        @case('rejected') status-rejected @break
                                        @case('withdrawn') status-withdrawn @break
                                    @endswitch">
                            @switch($app->status)
                                @case('pending')
                                    <i class="fas fa-clock"></i>
                                @break

                                @case('approved')
                                    <i class="fas fa-check-circle"></i>
                                @break

                                @case('rejected')
                                    <i class="fas fa-times-circle"></i>
                                @break

                                @case('withdrawn')
                                    <i class="fas fa-minus-circle"></i>
                                @break
                            @endswitch
                            {{ ucwords($app->status) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 text-xs text-slate-500">
                        <span class="flex items-center gap-1 min-w-0">
                            <i class="fas fa-school text-accent shrink-0"></i>
                            <span class="truncate">{{ $app->class?->name }}</span>
                        </span>

                        <span class="flex items-center gap-1 min-w-0">
                            <i class="fas fa-calendar-alt text-accent shrink-0"></i>
                            <span class="truncate">{{ $app->session?->name }} Session</span>
                        </span>

                        <span class="flex items-center gap-1 min-w-0">
                            <i class="fas fa-clock text-accent shrink-0"></i>
                            <span class="truncate">Applied {{ $app->created_at->diffForHumans() }}</span>
                        </span>

                        <span class="flex items-center gap-1 min-w-0">
                            @switch($app->status)
                                @case('pending')
                                    <i class="fas fa-clock text-amber-400 shrink-0"></i>
                                @break

                                @case('approved')
                                    <i class="fas fa-check-circle text-green-600 shrink-0"></i>
                                @break

                                @case('rejected')
                                    <i class="fas fa-times-circle text-red-600 shrink-0"></i>
                                @break

                                @case('withdrawn')
                                    <i class="fas fa-minus-circle text-gray-500 shrink-0"></i>
                                @break
                            @endswitch
                            <span class="truncate">{{ ucwords($app->status) }}</span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2 xl:justify-end">
                <a href="{{ route('applications.show', $app) }}"
                    class="bg-slate-100 text-slate-600 px-3 py-2 rounded-lg text-xs font-semibold hover:bg-slate-200 transition-all flex items-center gap-1">
                    <i class="fas fa-eye"></i>
                    <span>View</span>
                </a>

                @if ($app->status === 'pending')
                    <form method="POST" action="{{ route('applications.reject', $app) }}">
                        @csrf
                        @method('PUT')

                        <button onclick="showLoader()" type="submit"
                            class="bg-rose-50 text-rose-600 px-3 py-2 rounded-lg text-xs font-semibold hover:bg-rose-100 transition-all border border-rose-100 flex items-center gap-1">
                            <i class="fas fa-times"></i>
                            Reject
                        </button>
                    </form>
                @endif

                @if ($app->status === 'pending' || $app->status === 'rejected')
                    <form method="POST" action="{{ route('applications.approve', $app) }}">
                        @csrf
                        @method('PUT')

                        <button onclick="showLoader()" type="submit"
                            class="px-4 py-2 rounded-lg text-xs font-semibold transition-all flex items-center gap-1 border
                                    {{ $app->status === 'rejected'
                                        ? 'bg-amber-50 text-amber-600 border-amber-100 hover:bg-amber-100'
                                        : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }}">
                            <i class="fas {{ $app->status === 'rejected' ? 'fa-redo' : 'fa-check' }}"></i>
                            <span>{{ $app->status === 'rejected' ? 'Reconsider & Approve' : 'Approve' }}</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @empty
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center text-sm">
            No admission applications found.
        </div>
    @endforelse

    <div id="emptyState"
        class="hidden bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center text-sm">
    </div>
