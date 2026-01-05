        <div class="mb-6">
          <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
            <i class="fas fa-user text-accent text-xs"></i>
            Personal Information
          </h3>
          <p class="text-xs text-slate-500">Basic details about the admin</p>
        </div>

        <!-- Added 2-3 column responsive grid layout for form fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">First Name *</label>
            <input type="text" placeholder="Enter first name" name="first_name"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
              value="{{ old('first_name', $admin->user->first_name ?? '') }}">
            <span class="text-red-600 text-[10px] error-message" data-name="first_name"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Middle Name</label>
            <input type="text" placeholder="Enter middle name" name="middle_name"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
              value="{{ old('middle_name', $admin->user->middle_name ?? '') }}">
            <span class="text-red-600 text-[10px] error-message" data-name="middle_name"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Last Name
              (OPTIONAL)</label>
            <input type="text" placeholder="Enter last name" name="last_name"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
              value="{{ old('last_name', $admin->user->last_name ?? '') }}">
            <span class="text-red-600 text-[10px] error-message" data-name="last_name"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Email Address *</label>
            <input type="email" placeholder="admin@example.com" name="email"
              value="{{ old('email', $admin->user->email ?? '') }}"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="email"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Phone Number *</label>
            <input type="tel" placeholder="+1 (555) 000-0000" name="phone"
              value="{{ old('phone', $admin->user->phone ?? '') }}"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="phone"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Date of Birth *</label>
            <input type="date" name="date_of_birth"
              value="{{ old('date_of_birth', $admin->user->date_of_birth ?? '') }}"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="date_of_birth"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Gender *</label>
            <select name="gender"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
              <option value="">Select gender</option>

              <option value="male" {{ old('gender', $admin->user->gender ?? '') === 'male' ? 'selected' : '' }}>
                Male
              </option>

              <option value="female" {{ old('gender', $admin->user->gender ?? '') === 'female' ? 'selected' : '' }}>
                Female
              </option>
            </select>
            <span class="text-red-600 text-[10px] error-message" data-name="gender"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Religion</label>
            <input name="religion" type="text" placeholder="Enter Religion"
              value="{{ old('religion', $admin->user->religion ?? '') }}"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="religion"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Tribe </label>
            <input type="text" placeholder="Enter Tribe" name="tribe"
              value="{{ old('tribe', $admin->user->tribe ?? '') }}"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="tribe"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Nationality Of Origin
              *</label>
            <input type="text" placeholder="Enter nationality" name="nationality"
              value="{{ old('nationality', $admin->user->nationality ?? '') }}"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="nationality"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">State of Origin *</label>
            <input type="text" placeholder="Enter state" name="state"
              value="{{ old('state', $admin->user->state ?? '') }}"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="state"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Local Goverment Area of
              Origin *</label>
            <input type="text" placeholder="Enter LGA" name="local_government"
              value="{{ old('local_government', $admin->user->local_government ?? '') }}"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="local_government"></span>
          </div>

        </div>

        <div class="mb-6">
          <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
            <i class="fas fa-graduation-cap text-accent text-xs"></i>
            Professional Information
          </h3>
          <p class="text-xs text-slate-500">Teaching qualifications and experience</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Staff ID Number *</label>
            <input type="text" placeholder="e.g., TCH001" name="staff_number"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
              value="{{ old('staff_number', $admin->staff_number ?? '') }}">
            <span class="text-red-600 text-[10px] error-message" data-name="staff_number"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Highest Qualification
              *</label>
            <input name="highest_qualification" type="text" placeholder="Enter Qualification"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
              value="{{ old('highest_qualification', $admin->highest_qualification ?? '') }}">
            <span class="text-red-600 text-[10px] error-message" data-name="highest_qualification"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Years of
              Experience</label>
            <input type="number" placeholder="Enter years" min="0" name="years_of_experience"
              value="{{ old('years_of_experience', $admin->years_of_experience ?? '') }}"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="years_of_experience"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Employment Type *</label>
            <select name="employment_type"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
              <option value="">Select type</option>

              <option value="full_time"
                {{ old('employment_type', $admin->employment_type ?? '') === 'full_time' ? 'selected' : '' }}>
                Full Time
              </option>

              <option value="part_time"
                {{ old('employment_type', $admin->employment_type ?? '') === 'part_time' ? 'selected' : '' }}>
                Part Time
              </option>

              <option value="contract"
                {{ old('employment_type', $admin->employment_type ?? '') === 'contract' ? 'selected' : '' }}>
                Contract
              </option>
            </select>
            <span class="text-red-600 text-[10px] error-message" data-name="employment_type"></span>
          </div>

          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Admin Role *</label>
            <select name="role_type"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
              <option value="">Select role</option>

              <option value="super_admin"
                {{ old('role_type', $admin->role_type ?? '') === 'super_admin' ? 'selected' : '' }}>
                Super Admin
              </option>

              <option value="exam_officer"
                {{ old('role_type', $admin->role_type ?? '') === 'exam_officer' ? 'selected' : '' }}>
                Exam Officer
              </option>

              <option value="admission_officer"
                {{ old('role_type', $admin->role_type ?? '') === 'admission_officer' ? 'selected' : '' }}>
                Admission Officer
              </option>
            </select>
            <span class="text-red-600 text-[10px] error-message" data-name="role_type"></span>
          </div>
          <div>
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Date of Joining *</label>
            <input type="date" name="start_date" value="{{ old('start_date', $admin->start_date ?? '') }}"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <span class="text-red-600 text-[10px] error-message" data-name="start_date"></span>
          </div>
        </div>
        <div class="mb-6">
          <h3 class="text-base font-bold text-primary mb-1 flex items-center gap-2">
            <i class="fas fa-map-marker-alt text-accent text-xs"></i>
            Address Information
          </h3>
          <p class="text-xs text-slate-500">Residential address details</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
          <div class="md:col-span-2 lg:col-span-3">
            <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Residentai Address
              *</label>
            <textarea type="text" placeholder="Enter full home address" name="address"
              class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none h-20">{{ old('address', $admin->user->address ?? '') }}</textarea>
            <span class="text-red-600 text-[10px] error-message" data-name="address"></span>
          </div>

        </div>
