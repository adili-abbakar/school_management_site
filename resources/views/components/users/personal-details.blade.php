@props(['user' => ''])

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
          <!-- Personal Information -->
          <div class="bg-white rounded-lg border border-slate-200 p-4">
            <h3 class="text-sm font-semibold text-slate-800 mb-4 flex items-center gap-2">
              <i class="fas fa-user text-accent text-xs"></i> Personal Information
            </h3>
            <div class="space-y-3">
              <div>
                <label class="text-xs font-medium text-slate-600">Full Name</label>
                <p class="text-sm text-slate-800 mt-1">{{ $user->full_name }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Email</label>
                <p class="text-sm text-slate-800 mt-1">{{ $user->email }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Phone</label>
                <p class="text-sm text-slate-800 mt-1">{{ $user->phone }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Date of Birth</label>
                <p class="text-sm text-slate-800 mt-1">{{ $user->date_of_birth  != null ?  $user->date_of_birth->translatedFormat('l jS F Y') : 'Not Set' }}</p>
              </div>
              
              <div>
                <label class="text-xs font-medium text-slate-600">Religion</label>
                <p class="text-sm text-slate-800 mt-1">{{ $user->religion }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Tribe</label>
                <p class="text-sm text-slate-800 mt-1">{{ $user->tribe }}</p>
              </div>
                            <div>
                <label class="text-xs font-medium text-slate-600">Gender</label>
                <p class="text-sm text-slate-800 mt-1">{{ strtoupper($user->gender) }}</p>
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
                <p class="text-sm text-slate-800 mt-1">{{ $user->address }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Nationality (Origin)</label>
                <p class="text-sm text-slate-800 mt-1">{{ $user->nationality }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">State/Province (Orogin)</label>
                <p class="text-sm text-slate-800 mt-1">{{ $user->state }}</p>
              </div>
              <div>
                <label class="text-xs font-medium text-slate-600">Local Goverment Area/District</label>
                <p class="text-sm text-slate-800 mt-1">{{ $user->local_government }}</p>
              </div>
            </div>
          </div>
        </div>