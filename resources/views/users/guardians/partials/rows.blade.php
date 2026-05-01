         @forelse ($guardians as $guardian)
             <tr class="hover:bg-slate-50 transition-colors">
                 <td class="px-6 py-4">
                     <div class="flex flex-col">
                         <span class="font-semibold text-primary">
                             {{ $guardian->user->full_name }}
                         </span>
                         <span class="text-slate-500 text-[11px]">
                             {{ $guardian->user->email ?? 'No email provided' }}
                         </span>
                     </div>
                 </td>

                 {{-- <td class="px-6 py-4">
                     <span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded text-[10px] font-bold uppercase">
                         {{ $guardian->relationship ? str_replace('_', ' ', $guardian->relationship) : 'Not set' }}
                     </span>
                 </td> --}}

                 <td class="px-6 py-4 text-slate-500">
                     {{ $guardian->user->phone ?? 'No phone number' }}
                 </td>

                 <td class="px-6 py-4">
                     <div class="flex flex-col gap-1">
                         <span
                             class="inline-flex items-center gap-1 w-fit bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-[10px] font-bold">
                             <i class="fas fa-user-graduate text-[9px]"></i>
                             {{ $guardian->children_count ?? $guardian->children->count() }}
                             {{ ($guardian->children_count ?? $guardian->children->count()) == 1 ? 'Child' : 'Children' }}
                         </span>

                         @if (($guardian->children_count ?? $guardian->children->count()) > 0)
                             <span class="text-slate-500 text-[11px]">
                                 {{ $guardian->children->take(2)->pluck('user.full_name')->implode(', ') }}
                                 @if (($guardian->children_count ?? $guardian->children->count()) > 2)
                                     <span class="text-slate-400">
                                         +{{ ($guardian->children_count ?? $guardian->children->count()) - 2 }}
                                         more
                                     </span>
                                 @endif
                             </span>
                         @else
                             <span class="text-slate-400 text-[11px]">No children linked</span>
                         @endif
                     </div>
                 </td>

                 <td class="px-6 py-4 text-center">
                     <div class="flex justify-center gap-2">
                         <a href="{{ route('guardians.edit', $guardian->user_id) }}" class="text-blue-500"
                             title="Edit">
                             <i class="fas fa-edit"></i>
                         </a>

                         <a href="{{ route('user.edit-password', $guardian->user_id) }}"class="text-blue-500"
                             title="Edit Password">
                             <i class="fas fa-key"></i>
                         </a>

                         <a href="" class="text-green-500" title="View Details">
                             <i class="fas fa-eye"></i>
                         </a>

                         <a href="{{ route('guardians.delete', $guardian->user_id) }}" class="text-red-500" title="Delete">
                             <i class="fas fa-trash"></i>
                         </a>
                     </div>
                 </td>
             </tr>
         @empty
             <tr>
                 <td colspan="6" class="text-center text-gray-500 p-4">
                     No guardians found.
                 </td>
             </tr>
         @endforelse
