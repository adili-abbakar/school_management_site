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
          <x-buttons.blue-back-link>Admins</x-buttons.blue-back-link>
            <h1 class="text-xl font-bold text-slate-800">{{ $admin->user->full_name }}</h1>
            <p class="text-xs text-slate-500">Admin ID: {{ $admin->staff_number }}</p>
          </div>
          <div class="flex gap-2">
            <a href="{{ route('admins.edit', $admin) }}"
              class="px-3 py-1.5 bg-accent text-white text-xs rounded font-medium hover:bg-blue-600 transition flex items-center gap-1">
              <i class="fas fa-edit text-xs"></i> Edit
            </a>
            <a href="{{ route('admins.delete', $admin) }}"
              class="px-3 py-1.5 bg-red-500 text-white text-xs rounded font-medium hover:bg-red-600 transition flex items-center gap-1">
              <i class="fas fa-trash text-xs"></i> Delete
            </a>
          </div>
        </div>

        <!-- Admin Details Cards -->
        <x-users.personal-details :user="$admin->user" />

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
              <p class="text-sm text-slate-800 mt-1">{{ str_replace('_', ' ', strtoupper($admin->role_type)) }}</p>
            </div>

             <div>
              <label class="text-xs font-medium text-slate-600">Start Date</label>
              <p class="text-sm text-slate-800 mt-1">{{ $admin->start_date != null ? $admin->start_date->translatedFormat('l jS F Y') : "Not set" }}</p>
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
              <p class="text-sm text-slate-800 mt-1">{{ $admin->user->lastLogin() }}</p>
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
