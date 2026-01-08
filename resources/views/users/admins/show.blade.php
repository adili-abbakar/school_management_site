@extends('layouts.app')

@section('title', 'Admin Details')

@section('page-content')
  <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
    <x-dashboard-header />

    <main class="flex-1 overflow-y-auto p-4 md:p-6">
      <div class="max-w-4xl mx-auto">
        <!-- Header with Back Button -->
        <div class="flex items-center justify-between mb-6">
          <div>
            <a href="{{ route('admins.index') }}" class="text-accent text-xs mb-2 flex items-center gap-1 hover:underline">
              <i class="fas fa-arrow-left text-xs"></i> Back to Admins
            </a>
            <h1 class="text-xl font-bold text-slate-800">John Anderson</h1>
            <p class="text-xs text-slate-500">Admin ID: ADM-2024-001</p>
          </div>
          <div class="flex gap-2">
            <a href="{{ route('admins.edit', $admin->user_id) }}"
              class="px-3 py-1.5 bg-accent text-white text-xs rounded font-medium hover:bg-blue-600 transition flex items-center gap-1">
              <i class="fas fa-edit text-xs"></i> Edit
            </a>
            <button onclick="window.location.href='dashboard-delete-admin.html'"
              class="px-3 py-1.5 bg-red-500 text-white text-xs rounded font-medium hover:bg-red-600 transition flex items-center gap-1">
              <i class="fas fa-trash text-xs"></i> Delete
            </button>
          </div>
        </div>

        <!-- Admin Details Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
          <!-- Personal Information -->
          <div class="bg-white rounded-lg border border-slate-200 p-4">
            <h3 class="text-sm font-semibold text-slate-800 mb-4 flex items-center gap-2">
              <i class="fas fa-user text-accent text-xs"></i> Personal Information
            </h3>
            <div class="space-y-3">
              <div>
                <label class="text-xs font-medium text-slate-600">Full Name</label>
                <p class="text-sm text-slate-800 mt-1">{{ $admin->user->name() }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Email</label>
                <p class="text-sm text-slate-800 mt-1">{{ $admin->user->email }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Phone</label>
                <p class="text-sm text-slate-800 mt-1">{{ $admin->user->phone }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Date of Birth</label>
                <p class="text-sm text-slate-800 mt-1">{{ $admin->user->date_of_birth }}</p>
              </div>
              
              <div>
                <label class="text-xs font-medium text-slate-600">Religion</label>
                <p class="text-sm text-slate-800 mt-1">{{ $admin->user->religion }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Tribe</label>
                <p class="text-sm text-slate-800 mt-1">{{ $admin->user->tribe }}</p>
              </div>
                            <div>
                <label class="text-xs font-medium text-slate-600">Gender</label>
                <p class="text-sm text-slate-800 mt-1">{{ strtoupper($admin->user->gender) }}</p>
              </div>
            </div>
          </div>

          <!-- Address Information -->
          <div class="bg-white rounded-lg border border-slate-200 p-4">
            <h3 class="text-sm font-semibold text-slate-800 mb-4 flex items-center gap-2">
              <i class="fas fa-map-marker-alt text-accent text-xs"></i> Address
            </h3>
            <div class="space-y-3">
              <div>
                <label class="text-xs font-medium text-slate-600">Residential Address</label>
                <p class="text-sm text-slate-800 mt-1">{{ $admin->user->address }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Nationality (Origin)</label>
                <p class="text-sm text-slate-800 mt-1">{{ $admin->user->nationality }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">State/Province (Orogin)</label>
                <p class="text-sm text-slate-800 mt-1">{{ $admin->user->state }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Local Goverment Area/District</label>
                <p class="text-sm text-slate-800 mt-1">{{ $admin->user->local_government }}</p>
              </div>
            </div>
          </div>
        </div>

            <!-- Professional Information -->
        <div class="bg-white rounded-lg border border-slate-200 p-4 mb-6">
          <h3 class="text-sm font-semibold text-slate-800 mb-4 flex items-center gap-2">
            <i class="fas fa-lock text-accent text-xs"></i> Professional Information
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div>
              <label class="text-xs font-medium text-slate-600">Staff Number</label>
              <p class="text-sm text-slate-800 mt-1">{{ $admin->staff_number }}</p>
            </div>
            <div>
              <label class="text-xs font-medium text-slate-600">Years of Experience</label>
              <p class="text-sm text-slate-800 mt-1">
                {{ $admin->years_of_experience }}
              </p>
            </div>
            <div>
              <label class="text-xs font-medium text-slate-600">Highest Qualification</label>
              <p class="text-sm text-slate-800 mt-1">{{ $admin->highest_qualification }}</p>
            </div>

             <div>
              <label class="text-xs font-medium text-slate-600">Employment Type</label>
              <p class="text-sm text-slate-800 mt-1">{{ strtoupper($admin->employment_type) }}</p>
            </div>

             <div>
              <label class="text-xs font-medium text-slate-600">Start Date</label>
              <p class="text-sm text-slate-800 mt-1">{{ $admin->start_date }}</p>
            </div>
          </div>
        </div>

        <!-- Account & Permissions -->
        <div class="bg-white rounded-lg border border-slate-200 p-4 mb-6">
          <h3 class="text-sm font-semibold text-slate-800 mb-4 flex items-center gap-2">
            <i class="fas fa-lock text-accent text-xs"></i> Account & Permissions
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div>
              <label class="text-xs font-medium text-slate-600">Role</label>
              <p class="text-sm text-slate-800 mt-1">
                @php
                      $roleColors = [
                          'super_admin' => 'bg-blue-100 text-blue-700',
                          'exam_officer' => 'bg-green-100 text-green-700',
                          'admission_officer' => 'bg-purple-100 text-purple-700',
                      ];
                    @endphp

                    <span
                      class="{{ $roleColors[$admin->role_type] }} px-2 py-0.5 rounded text-[10px] font-bold uppercase">
                      {{ str_replace('_', ' ', strtoupper($admin->role_type)) }}
                    </span>
              
              </p>
            </div>
            <div>
              <label class="text-xs font-medium text-slate-600">Status</label>
              <p class="text-sm text-slate-800 mt-1">
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Active</span>
              </p>
            </div>
            <div>
              <label class="text-xs font-medium text-slate-600">Last Login</label>
              <p class="text-sm text-slate-800 mt-1">{{ $admin->user->last_login_at ? $admin->user->last_login_at->diffForHumans() : 'Never logged in' }}</p>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3 flex-wrap">
          <a href="{{ route('user.edit-password', $admin->user->id) }}"
            class="px-4 py-2 bg-slate-600 text-white text-xs rounded font-medium hover:bg-slate-700 transition flex items-center gap-2">
            <i class="fas fa-key text-xs"></i> Change Password
          </a>
          <a href="{{ route('admins.index') }}"
            class="px-4 py-2 bg-slate-300 text-slate-800 text-xs rounded font-medium hover:bg-slate-400 transition flex items-center gap-2">
            <i class="fas fa-arrow-left text-xs"></i> Back to List
          </a>
        </div>
      </div>
    </main>
  </main>
@endsection
