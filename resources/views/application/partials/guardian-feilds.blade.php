<!-- Parent/Guardian Information -->
<section>
    <h2 class="section-title">Parent / Guardian Information</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div>
            <label class="form-label">First Name <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="Enter first name" name="guardian_first_name" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_first_name"></span>
        </div>
        <div>
            <label class="form-label">Middle Name <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="Enter middle name" name="guardian_middle_name" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_middle_name"></span>
        </div>
        <div>
            <label class="form-label">Last Name </label>
            <input type="text" class="form-input" placeholder="Enter last name" name="guardian_last_name" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_last_name"></span>
        </div>
        <div>
            <label class="form-label">Date of Birth <span class="text-red-500">*</span></label>
            <input type="date" class="form-input" name="guardian_date_of_birth" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_date_of_birth"></span>
        </div>
        <div>
            <label class="form-label">Gender <span class="text-red-500">*</span></label>
            <select class="form-input" name="guardian_gender">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_gender"></span>
        </div>
        <div>
            <label class="form-label">Religion <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="e.g. Islam, Christianity" name="guardian_religion" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_religion"></span>
        </div>
        <div>
            <label class="form-label">Tribe <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="e.g. Hausa, Igbo, Yourba" name="guardian_tribe" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_tribe"></span>
        </div>
        <div>
            <label class="form-label">Nationality of origin <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="Enter Country" name="guardian_nationality" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_nationality"></span>
        </div>
        <div>
            <label class="form-label">State of origin <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="Enter State" name="guardian_state" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_state"></span>
        </div>
        <div>
            <label class="form-label">Local goverment area of origin <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="Enter Local goverment area"
                name="guardian_local_government" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_local_government"></span>
        </div>
        @guest
            <div>
                <label class="form-label">Relationship <span class="text-red-500">*</span></label>
                <select class="form-input" name="guardian_relationship">
                    <option value="">Select Relationship</option>
                    <option value="father">Father</option>
                    <option value="mother">Mother</option>
                    <option value="brother">Brother</option>
                    <option value="sister">Sister</option>
                    <option value="grandfather">Grandfather</option>
                    <option value="grandmother">Grandmother</option>
                    <option value="uncle">Uncle</option>
                    <option value="aunt">Aunt</option>
                    <option value="other">Other</option>
                </select>
                <span class="text-red-600 text-[10px] error-message" data-name="guardian_relationship"></span>
            </div>
        @endguest

        <div>
            <label class="form-label">Primary Phone <span class="text-red-500">*</span></label>
            <input type="tel" class="form-input" placeholder="+1 (555) 000-0000" name="guardian_phone" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_phone"></span>
        </div>
        <div class="lg:col-span-2">
            <label class="form-label">Email Address <span class="text-red-500">*</span></label>
            <input type="email" class="form-input" placeholder="guardian@example.com" name="guardian_email" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_email"></span>
        </div>
        <div>
            <label class="form-label">Occupation <span class="text-red-500">*</span></label>
            <input type="text" class="form-input" placeholder="e.g. Teacher" name="guardian_occupation" />
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_occupation"></span>
        </div>

        <div class="lg:col-span-3">
            <label class="form-label">Residential Address
                <span class="text-red-500">*</span></label>
            <textarea class="form-input h-20 resize-none" placeholder="Enter full home address" name="guardian_address"></textarea>
            <span class="text-red-600 text-[10px] error-message" data-name="guardian_address"></span>
        </div>

    </div>
</section>
