    @forelse ($students as $student)
        <tr class="hover:bg-slate-50 transition-colors">
            <td class="px-4 py-3 font-bold text-slate-400 uppercase text-[9px]">{{ $student->admission_number }}</td>
            <td class="px-4 py-3">
                <div class="flex items-center gap-2">
                    <div
                        class="w-7 h-7 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-[9px]">
                        JD</div>
                    <span class="font-semibold text-primary">{{ $student->user->full_name }}</span>
                </div>
            </td>
            <td class="px-4 py-3 text-slate-600 font-medium">{{ $student->currentClassArm->full_name }}</td>
            <td class="px-4 py-3 text-slate-500">{{ ucwords($student->user->gender) }}</td>
            <td class="px-4 py-3 text-slate-500">{{ $student->guardian->user->full_name }}</td>
            <td class="px-4 py-3 text-center">
                <div class="flex justify-center gap-2">
                    <button class="text-blue-500 hover:text-blue-700 transition-colors text-xs"><i
                            class="fas fa-edit"></i></button>
                    <button class="text-rose-500 hover:text-rose-700 transition-colors text-xs"><i
                            class="fas fa-trash"></i></button>
                </div>
            </td>
        </tr>
    @empty
         <tr>
        <td colspan="5" class="text-center text-gray-500 p-4">
            No students found.
        </td>
    </tr>
    @endforelse
