  @forelse ($sections as $section)
      <div class="session-card bg-white rounded-lg border border-slate-200 p-6 hover:shadow-lg">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
              <div>
                  <h2 class="text-primary font-semibold text-lg mb-1">{{ $section->name }} Academic Section
                      </h2>
                  <div class="flex flex-col md:flex-row gap-4 text-xs text-muted mt-2">
                      {{-- {{-- <div class="flex items-center gap-1.5">
                          <i class="fas fa-calendar text-accent"></i>
                          <span>Activity: <strong>{{ $section->startDate() }}</strong></span>
                      </div> --}}
                      <div class="flex items-center gap-1.5">
                          <i class="fas fa-info-circle"></i>
                          <span>Description: {{ $section->description }}</span>
                      </div>
                  </div>
              </div>
              <div class="flex gap-2 flex-wrap">
                  <a href="{{ route('sections.levels.create', $section) }}"
                      class="flex items-center gap-1 px-3 py-1 bg-green-100 text-green-600 rounded text-xs hover:bg-greeb-100 transition-colors">
                      <i class="fas fa-plus"></i>
                      <span>Add Level</span>
                  </a>
                  <a href="{{ route('sections.edit', $section) }}"
                      class="flex items-center gap-1 px-3 py-1 bg-blue-50 text-accent rounded text-xs hover:bg-blue-100 transition-colors">
                      <i class="fas fa-edit"></i>
                      <span>Edit</span>
                  </a>
                  <a href="{{ route('sections.delete', $section) }}"
                      class="flex items-center gap-1 px-3 py-1 bg-red-50 text-red-600 rounded text-xs hover:bg-red-100 transition-colors">
                      <i class="fas fa-trash"></i>
                      <span>Delete</span>
                  </a>
              </div>
          </div>

          <!-- Levels -->
          <div class="border-t border-slate-200 pt-4">
              <h3 class="text-sm font-semibold text-slate-700 mb-4">Levels</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                  @forelse ($section->levels as $level)
                      <div class="bg-gradient-to-br  from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                          <div class="flex items-start justify-between mb-2">
                              <h4 class="text-primary font-semibold text-sm">{{ $level->name }}</h4>
                          </div>
                          <div class="mt-3 flex gap-2">
                              <a href="{{ route('sections.levels.edit', [$section, $level]) }}"
                                  class="flex-1 text-center px-2 py-1 bg-white text-accent rounded text-xs hover:bg-slate-50 transition-colors border border-accent">
                                  <i class="fas fa-edit"></i>
                                  <span>Edit</span>
                              </a>
                              <a href="{{ route('sections.levels.delete', [$section, $level]) }}"
                                  class="flex-1 text-center px-2 py-1 bg-white text-red-600 rounded text-xs hover:bg-slate-50 transition-colors border border-red-200">
                                  <i class="fas fa-trash"></i>
                                  <span>Delete</span>
                              </a>
                          </div>

                      </div>
                  @empty
                      <div
                          class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center text-sm">
                          No level been created for this section yet.
                      </div>
                  @endforelse
              </div>
          </div>
      </div>
  @empty
      <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center text-sm">
          No academic sections found.
      </div>
  @endforelse
