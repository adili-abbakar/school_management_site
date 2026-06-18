  @forelse ($classes as $class)
      <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
          <button onclick="toggleArms(this)"
              class="w-full px-4 sm:px-5 py-4 hover:bg-slate-50 transition-colors text-left">
              <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                  <!-- Left Section -->
                  <div class="flex items-start gap-3 sm:gap-4 flex-1 min-w-0">
                      <i class="fas fa-chevron-down text-accent transition-transform duration-300 mt-1 shrink-0"></i>

                      <div class="min-w-0 flex-1">
                          <h3 class="font-bold text-primary text-sm sm:text-base break-words">
                              {{ $class->name }}
                              <small class="block sm:inline text-slate-500 font-medium">
                                  ({{ $class->nextClass ? 'Next: ' . $class->nextClass->name : 'Final' }})
                              </small>
                          </h3>
                          <p class="text-slate-500 text-xs mt-1"><b><big>Section: </big></b>{{ ucwords($class->section->name) }} section</p>
                          <p class="text-slate-500 text-xs mt-1"><b><big>Level: </big></b>{{ ucwords($class->level->name) }} level</p>
                      </div>
                  </div>

                  <!-- Stats Section -->
                  <div
                      class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-2 sm:gap-3 text-xs text-slate-600 w-full lg:w-auto">
                      <div class="flex items-center gap-1.5 bg-slate-50 px-3 py-2 rounded-md">
                          <i class="fas fa-users text-accent"></i>
                          <span>98 Students</span>
                      </div>

                      <div class="flex items-center gap-1.5 bg-slate-50 px-3 py-2 rounded-md">
                          <i class="fas fa-chalkboard-teacher text-accent"></i>
                          <span>{{ $class->teachersCount() }} Teachers</span>
                      </div>

                      <div class="flex items-center gap-1.5 bg-blue-50 text-accent px-3 py-2 rounded-md">
                          <i class="fas fa-layer-group"></i>
                          <span>{{ count($class->arms) }} Arms</span>
                      </div>
                  </div>
              </div>
          </button>

          <!-- Arms Container -->
          <div class="arms-container hidden border-t border-slate-200 bg-slate-50">
              <div class="p-3 sm:p-4 space-y-3">
                  @foreach ($class->arms as $arm)
                      <div
                          class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white p-3 rounded-lg border border-slate-100 text-xs">

                          <div class="flex-grow min-w-0">
                              <p class="font-semibold text-primary break-words">
                                  {{ $class->name . ' ' . $arm->name }}
                              </p>
                              <p class="text-slate-500 text-[10px] sm:text-xs break-words">
                                  33 Students • Teacher: {{ $arm->teacher?->name() ?? 'Not assigned' }}
                              </p>
                          </div>

                          <div class="flex items-center gap-3 sm:gap-2 shrink-0">
                              <a href="{{ route('class-arms.show', $arm) }}" class="text-accent hover:text-blue-700">
                                  <i class="fas fa-eye"></i>
                              </a>
                              <a href="{{ route('classes.edit', $class) }}" class="text-blue-500 hover:text-blue-700">
                                  <i class="fas fa-edit"></i>
                              </a>
                              <a href="{{ route('class-arms.delete', $arm) }}" class="text-red-500 hover:text-red-700">
                                  <i class="fas fa-trash"></i>
                              </a>
                          </div>
                      </div>
                  @endforeach
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 px-3 sm:px-4 pb-4 text-xs">
                  <a href="{{ route('classes.edit', $class) }}"
                      class="bg-blue-50 text-accent px-3 py-2 rounded hover:bg-blue-100 transition text-center font-semibold">
                      <i class="fas fa-edit mr-1"></i>Edit Class
                  </a>

                  <a href="{{ route('classes.delete', $class) }}"
                      class="bg-red-50 text-red-500 px-3 py-2 rounded hover:bg-red-100 transition text-center font-semibold">
                      <i class="fas fa-trash mr-1"></i>Delete
                  </a>
              </div>
          </div>
      </div>
  @empty
      <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg p-4 text-center text-sm">
          No academic classes found.
      </div>
  @endforelse
