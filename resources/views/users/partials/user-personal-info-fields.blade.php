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
            value="{{ old('first_name', $user?->first_name) }}">
        <span class="text-red-600 text-[10px] error-message" data-name="first_name"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Middle Name</label>
        <input type="text" placeholder="Enter middle name" name="middle_name"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            value="{{ old('middle_name', $user?->middle_name) }}">
        <span class="text-red-600 text-[10px] error-message" data-name="middle_name"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Last Name
            (OPTIONAL)</label>
        <input type="text" placeholder="Enter last name" name="last_name"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none"
            value="{{ old('last_name', $user?->last_name) }}">
        <span class="text-red-600 text-[10px] error-message" data-name="last_name"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Email Address *</label>
        <input type="email" placeholder="admin@example.com" name="email" value="{{ old('email', $user?->email) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="email"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Phone Number *</label>
        <input type="tel" placeholder="+1 (555) 000-0000" name="phone" value="{{ old('phone', $user?->phone) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="phone"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Date of Birth *</label>
        <input type="date" name="date_of_birth"
            value="{{ old('date_of_birth', $user?->date_of_birth?->format('Y-m-d')) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="date_of_birth"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Gender *</label>
        <select name="gender"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
            <option value="">Select gender</option>

            <option value="male" {{ old('gender', $user?->gender) === 'male' ? 'selected' : '' }}>
                Male
            </option>

            <option value="female" {{ old('gender', $user?->gender) === 'female' ? 'selected' : '' }}>
                Female
            </option>
        </select>
        <span class="text-red-600 text-[10px] error-message" data-name="gender"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Religion</label>
        <input name="religion" type="text" placeholder="Enter Religion"
            value="{{ old('religion', $user?->religion) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="religion"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Tribe </label>
        <input type="text" placeholder="Enter Tribe" name="tribe" value="{{ old('tribe', $user?->tribe) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="tribe"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Nationality Of Origin
            *</label>
        <input type="text" placeholder="Enter nationality" name="nationality"
            value="{{ old('nationality', $user?->nationality) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="nationality"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">State of Origin *</label>
        <input type="text" placeholder="Enter state" name="state" value="{{ old('state', $user?->state) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="state"></span>
    </div>
    <div>
        <label class="block text-[9px] font-bold text-slate-500 uppercase mb-1.5">Local Goverment Area of
            Origin *</label>
        <input type="text" placeholder="Enter LGA" name="local_government"
            value="{{ old('local_government', $user?->local_government) }}"
            class="w-full bg-slate-50 border border-slate-200 rounded-lg py-2 px-3 text-xs focus:ring-2 focus:ring-accent outline-none">
        <span class="text-red-600 text-[10px] error-message" data-name="local_government"></span>
    </div>

</div>
