<form id="taxpayerForm">
@csrf
<input type="hidden" name="id" value="{{ $taxpayer->id ?? '' }}">

<div class="card shadow-sm">
    <div class="card-body">
        
        <h4 class="mb-4">TAX PAYER INFORMATION</h4>

        <div class="row">

            <div class="col-md-4 mb-3">
                <label>First Name *</label>
                <input type="text" name="first_name" 
                       value="{{ old('first_name', $taxpayer->first_name ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_first_name_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Middle Name</label>
                <input type="text" name="middle_name"
                       value="{{ old('middle_name', $taxpayer->middle_name ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_middle_name_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Last Name *</label>
                <input type="text" name="last_name"
                       value="{{ old('last_name', $taxpayer->last_name ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_last_name_error"></small>
            </div>

            <div class="col-md-6 mb-3">
                <label>SSN / ITIN Number</label>
                <input type="text" name="ssn_itin"
                       value="{{ old('ssn_itin', $taxpayer->ssn_itin ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_ssn_itin_error"></small>
            </div>

            <div class="col-md-6 mb-3">
                <label>Occupation</label>
                <input type="text" name="occupation"
                       value="{{ old('occupation', $taxpayer->occupation ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_occupation_error"></small>
            </div>
        </div>

        <h5 class="mt-4 mb-3 text-primary">DOB & GENDER</h5>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dob"
                       value="{{ old('dob', $taxpayer->dob ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_dob_error"></small>
            </div>

            <div class="col-md-6 mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender', $taxpayer->gender ?? '')=='Male'?'selected':'' }}>Male</option>
                    <option value="Female" {{ old('gender', $taxpayer->gender ?? '')=='Female'?'selected':'' }}>Female</option>
                    <option value="Other" {{ old('gender', $taxpayer->gender ?? '')=='Other'?'selected':'' }}>Other</option>
                </select>
                <small class="error-text" id="taxpayer_gender_error"></small>
            </div>
        </div>

        <h5 class="mt-4 mb-3 text-primary">CONTACT DETAILS</h5>

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Email *</label>
                <input type="email" name="email"
                       value="{{ old('email', $taxpayer->email ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_email_error"></small>
            </div>

            <div class="col-md-6 mb-3">
                <label>Mobile Number</label>
                <input type="text" name="mobile"
                       value="{{ old('mobile', $taxpayer->mobile ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_mobile_error"></small>
            </div>

            <div class="col-md-6 mb-3">
                <label>Alternate Mobile Number</label>
                <input type="text" name="alt_mobile"
                       value="{{ old('alt_mobile', $taxpayer->alt_mobile ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_alt_mobile_error"></small>
            </div>

            <div class="col-md-6 mb-3">
                <label>Apartment / Street No</label>
                <input type="text" name="street"
                       value="{{ old('street', $taxpayer->street ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_street_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>State</label>
                <input type="text" name="state"
                       value="{{ old('state', $taxpayer->state ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_state_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Country</label>
                <input type="text" name="country"
                       value="{{ old('country', $taxpayer->country ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_country_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Zip Code</label>
                <input type="text" name="zip"
                       value="{{ old('zip', $taxpayer->zip ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_zip_error"></small>
            </div>
        </div>

        <h5 class="mt-4 mb-3 text-primary">OTHER DETAILS</h5>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Select Visa Type</label>
                <input type="text" name="visa_type"
                       value="{{ old('visa_type', $taxpayer->visa_type ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_visa_type_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Current Employer</label>
                <input type="text" name="current_employer"
                       value="{{ old('current_employer', $taxpayer->current_employer ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_current_employer_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Filing Status</label>
                <input type="text" name="filing_status"
                       value="{{ old('filing_status', $taxpayer->filing_status ?? '') }}"
                       class="form-control">
                <small class="error-text" id="taxpayer_filing_status_error"></small>
            </div>
        </div>

    </div>
</div>

</form>
