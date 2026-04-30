@forelse ($admins as $admin)
    <tr class="hover:bg-slate-50 transition-colors">
        <td class="px-6 py-4 font-bold text-slate-400 uppercase">
            {{ $admin->staff->staff_number }}
        </td>

        <td class="px-6 py-4 font-semibold text-primary">
            {{ $admin->user->full_name }}
        </td>

        <td class="px-6 py-4">
            @php
                $roleColors = [
                    'super_admin' => 'bg-blue-100 text-blue-700',
                    'exam_officer' => 'bg-green-100 text-green-700',
                    'admission_officer' => 'bg-purple-100 text-purple-700',
                ];
            @endphp

            <span
                class="{{ $roleColors[$admin->role_type] ?? 'bg-slate-100 text-slate-700' }} px-2 py-0.5 rounded text-[10px] font-bold uppercase">
                {{ str_replace('_', ' ', strtoupper($admin->role_type)) }}
            </span>
        </td>

        <td class="px-6 py-4 text-slate-500">
            {{ $admin->user->last_login_at ? $admin->user->last_login_at->diffForHumans() : 'Never logged in' }}
        </td>

        <td class="px-6 py-4 text-center">
            <div class="flex justify-center gap-2">
                <a href="{{ route('admins.edit', $admin) }}" class="text-blue-500" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>

                <a href="{{ route('user.edit-password', $admin) }}" class="text-blue-500" title="Edit Password">
                    <i class="fas fa-key"></i>
                </a>

                <a href="{{ route('admins.show', $admin) }}" class="text-green-500" title="View Details">
                    <i class="fas fa-eye"></i>
                </a>

                <a href="{{ route('admins.delete', $admin) }}" class="text-red-500" title="Delete">
                    <i class="fas fa-trash"></i>
                </a>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center text-gray-500 p-4">
            No admins found.
        </td>
    </tr>
@endforelse
