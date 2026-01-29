@extends('layouts.app')

@section('title', 'Acadeimc Sessions')

@section('page-content')
  <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
    <x-dashboard-header />

    <div class="flex-1 overflow-y-auto">
      <div class="p-4 md:p-8">
        <!-- Sessions Grid -->
        <div class="space-y-4">
          <!-- Session 2024/2025 -->
          <div class="session-card bg-white rounded-lg border border-slate-200 p-6 hover:shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
              <div>
                <h2 class="text-primary font-semibold text-lg mb-1">Academic Session 2024/2025</h2>
                <div class="flex flex-col md:flex-row gap-4 text-xs text-muted mt-2">
                  <div class="flex items-center gap-1.5">
                    <i class="fas fa-calendar text-accent"></i>
                    <span>Starts: <strong>September 1, 2024</strong></span>
                  </div>
                  <div class="flex items-center gap-1.5">
                    <i class="fas fa-calendar text-accent"></i>
                    <span>Ends: <strong>July 31, 2025</strong></span>
                  </div>
                </div>
              </div>
              <div class="flex gap-2 flex-wrap">
                <a href="#"
                  class="flex items-center gap-1 px-3 py-1 bg-blue-50 text-accent rounded text-xs hover:bg-blue-100 transition-colors">
                  <i class="fas fa-edit"></i>
                  <span>Edit</span>
                </a>
                <a href="#"
                  class="flex items-center gap-1 px-3 py-1 bg-red-50 text-red-600 rounded text-xs hover:bg-red-100 transition-colors">
                  <i class="fas fa-trash"></i>
                  <span>Delete</span>
                </a>
              </div>
            </div>

            <!-- Terms -->
            <div class="border-t border-slate-200 pt-4">
              <h3 class="text-sm font-semibold text-slate-700 mb-4">Terms</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Term 1 -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                  <div class="flex items-start justify-between mb-2">
                    <h4 class="text-primary font-semibold text-sm">First Term</h4>
                    <span class="bg-blue-200 text-primary px-2 py-0.5 rounded text-xs font-semibold">Active</span>
                  </div>
                  <div class="space-y-2 text-xs text-slate-700">
                    <div class="flex items-center gap-2">
                      <i class="fas fa-play text-green-600"></i>
                      <span>Start: <strong>Sep 1, 2024</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                      <i class="fas fa-stop text-red-600"></i>
                      <span>End: <strong>Nov 30, 2024</strong></span>
                    </div>
                  </div>
                  <div class="mt-3 flex gap-2">
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-accent rounded text-xs hover:bg-slate-50 transition-colors border border-accent">
                      Edit
                    </a>
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-red-600 rounded text-xs hover:bg-slate-50 transition-colors border border-red-200">
                      Delete
                    </a>
                  </div>
                </div>

                <!-- Term 2 -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                  <div class="flex items-start justify-between mb-2">
                    <h4 class="text-primary font-semibold text-sm">Second Term</h4>
                    <span class="bg-purple-200 text-primary px-2 py-0.5 rounded text-xs font-semibold">Upcoming</span>
                  </div>
                  <div class="space-y-2 text-xs text-slate-700">
                    <div class="flex items-center gap-2">
                      <i class="fas fa-play text-green-600"></i>
                      <span>Start: <strong>Dec 1, 2024</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                      <i class="fas fa-stop text-red-600"></i>
                      <span>End: <strong>Mar 31, 2025</strong></span>
                    </div>
                  </div>
                  <div class="mt-3 flex gap-2">
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-accent rounded text-xs hover:bg-slate-50 transition-colors border border-accent">
                      Edit
                    </a>
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-red-600 rounded text-xs hover:bg-slate-50 transition-colors border border-red-200">
                      Delete
                    </a>
                  </div>
                </div>

                <!-- Term 3 -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border border-green-200">
                  <div class="flex items-start justify-between mb-2">
                    <h4 class="text-primary font-semibold text-sm">Third Term</h4>
                    <span class="bg-green-200 text-primary px-2 py-0.5 rounded text-xs font-semibold">Upcoming</span>
                  </div>
                  <div class="space-y-2 text-xs text-slate-700">
                    <div class="flex items-center gap-2">
                      <i class="fas fa-play text-green-600"></i>
                      <span>Start: <strong>Apr 1, 2025</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                      <i class="fas fa-stop text-red-600"></i>
                      <span>End: <strong>Jul 31, 2025</strong></span>
                    </div>
                  </div>
                  <div class="mt-3 flex gap-2">
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-accent rounded text-xs hover:bg-slate-50 transition-colors border border-accent">
                      Edit
                    </a>
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-red-600 rounded text-xs hover:bg-slate-50 transition-colors border border-red-200">
                      Delete
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Session 2023/2024 -->
          <div class="session-card bg-white rounded-lg border border-slate-200 p-6 hover:shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
              <div>
                <h2 class="text-primary font-semibold text-lg mb-1">Academic Session 2023/2024</h2>
                <div class="flex flex-col md:flex-row gap-4 text-xs text-muted mt-2">
                  <div class="flex items-center gap-1.5">
                    <i class="fas fa-calendar text-accent"></i>
                    <span>Starts: <strong>September 1, 2023</strong></span>
                  </div>
                  <div class="flex items-center gap-1.5">
                    <i class="fas fa-calendar text-accent"></i>
                    <span>Ends: <strong>July 31, 2024</strong></span>
                  </div>
                </div>
              </div>
              <div class="flex gap-2 flex-wrap">
                <a href="#"
                  class="flex items-center gap-1 px-3 py-1 bg-blue-50 text-accent rounded text-xs hover:bg-blue-100 transition-colors">
                  <i class="fas fa-edit"></i>
                  <span>Edit</span>
                </a>
                <a href="#"
                  class="flex items-center gap-1 px-3 py-1 bg-red-50 text-red-600 rounded text-xs hover:bg-red-100 transition-colors">
                  <i class="fas fa-trash"></i>
                  <span>Delete</span>
                </a>
              </div>
            </div>

            <!-- Terms -->
            <div class="border-t border-slate-200 pt-4">
              <h3 class="text-sm font-semibold text-slate-700 mb-4">Terms</h3>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Term 1 -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-4 border border-gray-200">
                  <div class="flex items-start justify-between mb-2">
                    <h4 class="text-primary font-semibold text-sm">First Term</h4>
                    <span class="bg-gray-300 text-primary px-2 py-0.5 rounded text-xs font-semibold">Completed</span>
                  </div>
                  <div class="space-y-2 text-xs text-slate-700">
                    <div class="flex items-center gap-2">
                      <i class="fas fa-play text-green-600"></i>
                      <span>Start: <strong>Sep 1, 2023</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                      <i class="fas fa-stop text-red-600"></i>
                      <span>End: <strong>Nov 30, 2023</strong></span>
                    </div>
                  </div>
                  <div class="mt-3 flex gap-2">
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-accent rounded text-xs hover:bg-slate-50 transition-colors border border-accent">
                      Edit
                    </a>
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-red-600 rounded text-xs hover:bg-slate-50 transition-colors border border-red-200">
                      Delete
                    </a>
                  </div>
                </div>

                <!-- Term 2 -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-4 border border-gray-200">
                  <div class="flex items-start justify-between mb-2">
                    <h4 class="text-primary font-semibold text-sm">Second Term</h4>
                    <span class="bg-gray-300 text-primary px-2 py-0.5 rounded text-xs font-semibold">Completed</span>
                  </div>
                  <div class="space-y-2 text-xs text-slate-700">
                    <div class="flex items-center gap-2">
                      <i class="fas fa-play text-green-600"></i>
                      <span>Start: <strong>Dec 1, 2023</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                      <i class="fas fa-stop text-red-600"></i>
                      <span>End: <strong>Mar 31, 2024</strong></span>
                    </div>
                  </div>
                  <div class="mt-3 flex gap-2">
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-accent rounded text-xs hover:bg-slate-50 transition-colors border border-accent">
                      Edit
                    </a>
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-red-600 rounded text-xs hover:bg-slate-50 transition-colors border border-red-200">
                      Delete
                    </a>
                  </div>
                </div>

                <!-- Term 3 -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-4 border border-gray-200">
                  <div class="flex items-start justify-between mb-2">
                    <h4 class="text-primary font-semibold text-sm">Third Term</h4>
                    <span class="bg-gray-300 text-primary px-2 py-0.5 rounded text-xs font-semibold">Completed</span>
                  </div>
                  <div class="space-y-2 text-xs text-slate-700">
                    <div class="flex items-center gap-2">
                      <i class="fas fa-play text-green-600"></i>
                      <span>Start: <strong>Apr 1, 2024</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                      <i class="fas fa-stop text-red-600"></i>
                      <span>End: <strong>Jul 31, 2024</strong></span>
                    </div>
                  </div>
                  <div class="mt-3 flex gap-2">
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-accent rounded text-xs hover:bg-slate-50 transition-colors border border-accent">
                      Edit
                    </a>
                    <a href="#"
                      class="flex-1 text-center px-2 py-1 bg-white text-red-600 rounded text-xs hover:bg-slate-50 transition-colors border border-red-200">
                      Delete
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script src="{{ asset('/js/formSubmitter.js') }}"></script>

@endsection
