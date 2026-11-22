  @extends('layouts.app')

  @section('title', 'Student Details')

  @section('page-content')
      <main class="flex-grow flex flex-col min-w-0  overflow-y-auto">
          <x-dashboard-header />

          <main class="flex-1 overflow-y-auto p-4 md:p-6">
              <!-- Header with Back Button -->
              <div class="flex items-center justify-between mb-6">
                  <div>
                      <x-buttons.blue-back-link>Students</x-buttons.blue-back-link>

                      <h1 class="text-xl font-bold text-slate-800">{{ $student->user->full_name }}</h1>
                      <p class="text-xs text-slate-500">Admission Number: {{ $student->admission_number }}</p>
                  </div>
                  <div class="flex gap-2">
                      <a href="{{ route('students.edit', $student) }}"
                          class="px-3 py-1.5 bg-accent text-white text-xs rounded font-medium hover:bg-blue-600 transition flex items-center gap-1">
                          <i class="fas fa-edit text-xs"></i> Edit
                      </a>
                      <button onclick="window.location.href='dashboard-delete-student.html'"
                          class="px-3 py-1.5 bg-red-500 text-white text-xs rounded font-medium hover:bg-red-600 transition flex items-center gap-1">
                          <i class="fas fa-trash text-xs"></i> Delete
                      </button>
                  </div>
              </div>


              <!-- Personal Information -->
              @include('users.partials.personal-details', ['user' => $student->user])

              <!-- Guardian Information Section -->
              <div class="bg-white rounded-lg border border-slate-200 p-4 mb-6">
                  <div class="flex items-center justify-between mb-4">
                      <h3 class="text-sm font-semibold text-slate-800 flex items-center gap-2">
                          <i class="fas fa-user-shield text-accent text-xs"></i> Guardian Information
                      </h3>
                      <a href="dashboard-show-guardian.html"
                          class="text-accent text-xs font-medium hover:underline flex items-center gap-1">
                          View Guardian Profile <i class="fas fa-arrow-right text-xs"></i>
                      </a>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                          <label class="text-xs font-medium text-slate-600">Guardian Name</label>
                          <p class="text-sm text-slate-800 mt-1">{{ $student->guardian->user->fullName ?? 'Not Set' }}</p>
                      </div>
                      <div>
                          <label class="text-xs font-medium text-slate-600">Relationship</label>
                          <p class="text-sm text-slate-800 mt-1">{{ $student->guardian_relationship ?? 'Not Set' }}</p>
                      </div>
                      <div>
                          <label class="text-xs font-medium text-slate-600">Contact Phone</label>
                          <p class="text-sm text-slate-800 mt-1">{{ $student->guardian->user->phone ?? 'Not Set' }}</p>
                      </div>
                      <div>
                          <label class="text-xs font-medium text-slate-600">Email</label>
                          <p class="text-sm text-slate-800 mt-1">{{ $student->guardian->user->email ?? 'Not Set' }}</p>
                      </div>
                  </div>
              </div>

              <div class="flex items-center justify-between mb-6">
                  <div>
                      <h1 class="text-xl font-bold text-slate-800 gap-2 flex items-center">
                          <i class="fas fa-graduation-cap text-accent text-xs"></i> Enrolled Programs
                      </h1>
                  </div>
              </div>

              <!-- Student Details Cards -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                  @forelse ($student->programEnrollments as $programEnrollment)
                      <!-- Enrollment Details -->
                      <div class="bg-white rounded-lg border border-slate-200 p-4">
                          <h3 class="text-sm font-semibold text-slate-800 mb-4 flex items-center">
                              {{ $programEnrollment->program->name }}
                          </h3>
                          <div class="space-y-3">
                              <div>
                                  <label class="text-xs font-medium text-slate-600">Current Class</label>
                                  <p class="text-sm text-slate-800 mt-1">
                                      {{ $programEnrollment->activeSessionRecord->class->name ?? 'Not Assigned' }}</p>
                              </div>
                              <div>
                                  <label class="text-xs font-medium text-slate-600">Session</label>
                                  <p class="text-sm text-slate-800 mt-1">
                                      {{ $programEnrollment->activeSessionRecord->session->name ?? 'Not Assigned' }}</p>
                              </div>
                              <div>
                                  <label class="text-xs font-medium text-slate-600">Enrollment Date</label>
                                  <p class="text-sm text-slate-800 mt-1">
                                      {{ $programEnrollment->activeSessionRecord->session->start_date != null ? $programEnrollment->activeSessionRecord->session->start_date->translatedFormat('l jS F Y') : 'Not set' }}
                                  </p>
                              </div>
                              <div>
                                  <label class="text-xs font-medium text-slate-600">Status</label>
                                  <p class="text-sm text-slate-800 mt-1">
                                      <span
                                          class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">{{ $programEnrollment->status }}</span>
                                  </p>
                              </div>
                          </div>
                      </div>
                  @empty
                      <div>Not enrolled in any programs.</div>
                  @endforelse
              </div>



              <!-- Action Buttons -->
              <div class="flex gap-3 flex-wrap">
                  <a href="dashboard-edit-student.html?field=password"
                      class="px-4 py-2 bg-slate-600 text-white text-xs rounded font-medium hover:bg-slate-700 transition flex items-center gap-2">
                      <i class="fas fa-key text-xs"></i> Change Password
                  </a>
                  <a href="dashboard-students.html"
                      class="px-4 py-2 bg-slate-300 text-slate-800 text-xs rounded font-medium hover:bg-slate-400 transition flex items-center gap-2">
                      <i class="fas fa-arrow-left text-xs"></i> Back to List
                  </a>
              </div>
              </div>
          </main>
      @endsection
