@extends('layouts.app')

@section('title', 'Academic Staffs')

@section('page-content')
  <main class="flex-grow flex flex-col min-w-0 bg-slate-50 overflow-y-auto">
    <x-dashboard-header>
      <div class="flex items-center gap-4 flex-grow max-w-xl">
        <div class="relative w-full">
          <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
          <input type="text" placeholder="Search staff..."
            class="w-full bg-slate-100 border-none rounded-lg py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-accent outline-none">
        </div>
      </div>
    </x-dashboard-header>

    <div class="p-6">
      <div class="flex justify-between items-center mb-6">
        <div>
          <h1 class="text-xl font-extrabold text-primary">Academic Staff</h1>
          <p class="text-slate-500 text-xs">Manage teachers and faculty members.</p>
        </div>
        <a href="{{ route('teachers.create') }}">
          <button
            class="bg-accent text-white px-4 py-2 rounded-lg text-xs font-semibold shadow hover:bg-blue-600 transition-all flex items-center gap-2">
            <i class="fas fa-plus"></i>
            <span>Add New Teacher</span>
          </button>
        </a>
      </div>

      <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-bold tracking-wider">
              <tr>
                <th class="px-6 py-4">Staff ID</th>
                <th class="px-6 py-4">Name</th>
                <th class="px-6 py-4">Subject</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4 text-center">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y">
              @forelse($teachers as  $teacher)
                <tr class="hover:bg-slate-50 transition-colors">
                  <td class="px-6 py-4 font-bold text-slate-400 uppercase">{{ $teacher->staff_number }}</td>
                  <td class="px-6 py-4 font-semibold text-primary">{{ $teacher->user->full_name }}</td>
                  <td class="px-6 py-4 text-slate-600">{{ $teacher->specialized_subject }}</td>
                  <td class="px-6 py-4 text-slate-500">{{ $teacher->user->email }}</td>
                  <td class="px-6 py-4 text-center">
                    <div class="flex justify-center gap-2">
                     
                      <a href="{{ route('teachers.edit', $teacher->user_id) }}">
                        <button class="text-blue-500"><i class="fas fa-edit"></i></button>
                      </a>
                       <a href="{{ route('user.edit-password', $teacher->user_id) }}">
                        <button class="text-blue-500" title="Edit Password"><i class="fas fa-key"></i></button>
                      </a>
                      <a href="{{ route('teachers.show', $teacher->user_id) }}">
                        <button class="text-green-500" title="View Details"><i class="fas fa-eye"></i></button>
                      </a>
                      <a href="{{ route('teachers.delete', $teacher->user_id) }}">
                        <button class="text-rose-500"><i class="fas fa-trash"></i></button>
                      </a>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-gray-500 p-4">
                    No teachers found.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
@endsection
