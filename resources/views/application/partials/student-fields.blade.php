<!-- Student Details -->
<section>
    <h2 class="section-title">Student Information</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div>
            <label class="form-label">First Name <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="Enter first name" name="student_first_name" />
            <span class="text-red-600 text-[10px] error-message" data-name="student_first_name"></span>
        </div>
        <div>
            <label class="form-label">Middle Name <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="Enter middle name" name = 'student_middle_name' />
            <span class="text-red-600 text-[10px] error-message" data-name="student_middle_name"></span>
        </div>
        <div>
            <label class="form-label">Last Name </label>
            <input type="text" class="form-input" placeholder="Enter last name" name="student_last_name" />
            <span class="text-red-600 text-[10px] error-message" data-name="student_last_name"></span>
        </div>
        <div>
            <label class="form-label">Date of Birth <span class="text-red-500">*</span></label>
            <input type="date" class="form-input" name="student_date_of_birth" />
            <span class="text-red-600 text-[10px] error-message" data-name="student_date_of_birth"></span>
        </div>
        <div>
            <label class="form-label">Gender <span class="text-red-500">*</span></label>
            <select class="form-input" name="student_gender">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <span class="text-red-600 text-[10px] error-message" data-name="student_gender"></span>
        </div>
        <div>
            <label class="form-label">Religion <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="e.g. Islam, Christianity" name="student_religion" />
            <span class="text-red-600 text-[10px] error-message" data-name="student_religion"></span>
        </div>
        <div>
            <label class="form-label">Tribe <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="e.g. Hausa, Igbo, Yourba" name="student_tribe" />
            <span class="text-red-600 text-[10px] error-message" data-name="student_tribe"></span>
        </div>
        <div>
            <label class="form-label">Nationality of origin <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="Enter Country" name="student_nationality" />
            <span class="text-red-600 text-[10px] error-message" data-name="student_nationality"></span>
        </div>
        <div>
            <label class="form-label">State of origin <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="Enter State" name="student_state" />
            <span class="text-red-600 text-[10px] error-message" data-name="student_state"></span>
        </div>
        <div>
            <label class="form-label">Local goverment area of origin <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="Enter Local goverment area"
                name="student_local_government" />
            <span class="text-red-600 text-[10px] error-message" data-name="student_local_government"></span>
        </div>

        <div class="lg:col-span-3">
            <label class="form-label">Residential Address
                <span class="text-red-500">*</span></label>
            <textarea class="form-input h-20 resize-none" placeholder="Enter full home address" name="student_address"></textarea>
            <span class="text-red-600 text-[10px] error-message" data-name="student_address"></span>
        </div>
    </div>
</section>
