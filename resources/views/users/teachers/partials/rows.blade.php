  @forelse($teachers as  $teacher)
      <tr class="hover:bg-slate-50 transition-colors">
          <td class="px-6 py-4 font-bold text-slate-400 uppercase">{{ $teacher->staff->staff_number }}</td>
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
