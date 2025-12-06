<form id="spouseForm">
@csrf

<input type="hidden" name="id" value="{{ $spouse->id ?? '' }}">

<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="mb-4">SPOUSE INFORMATION</h4>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>First Name *</label>
                <input type="text" name="first_name"
                       value="{{ old('first_name', $spouse->first_name ?? '') }}"
                       class="form-control">
                <small class="error-text" id="spouse_first_name_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Middle Name</label>
                <input type="text" name="middle_name"
                       value="{{ old('middle_name', $spouse->middle_name ?? '') }}"
                       class="form-control">
                <small class="error-text" id="spouse_middle_name_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Last Name *</label>
                <input type="text" name="last_name"
                       value="{{ old('last_name', $spouse->last_name ?? '') }}"
                       class="form-control">
                <small class="error-text" id="spouse_last_name_error"></small>
            </div>
        </div>

        <h5 class="mt-4 mb-3 text-primary">DOB & GENDER</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Date of Birth</label>
                <input type="date" name="dob"
                       value="{{ old('dob', $spouse->dob ?? '') }}"
                       class="form-control">
                <small class="error-text" id="spouse_dob_error"></small>
            </div>

            <div class="col-md-6 mb-3">
                <label>Gender</label>
                <select name="gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender', $spouse->gender ?? '')=='Male'?'selected':'' }}>Male</option>
                    <option value="Female" {{ old('gender', $spouse->gender ?? '')=='Female'?'selected':'' }}>Female</option>
                    <option value="Other" {{ old('gender', $spouse->gender ?? '')=='Other'?'selected':'' }}>Other</option>
                </select>
                <small class="error-text" id="spouse_gender_error"></small>
            </div>
        </div>

        <h5 class="mt-4 mb-3 text-primary">OTHER DETAILS</h5>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Select Tax Id Type</label>
                <select name="tax_id_type" class="form-control">
                    <option value="">Select Tax Id Type</option>
                    <option value="SSN/ITIN" {{ old('tax_id_type', $spouse->tax_id_type ?? '')=='SSN/ITIN'?'selected':'' }}>SSN/ITIN</option>
                    <option value="Applying for ITIN" {{ old('tax_id_type', $spouse->tax_id_type ?? '')=='Applying for ITIN'?'selected':'' }}>Applying for ITIN</option>
                </select>
                <small class="error-text" id="spouse_tax_id_type_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Occupation</label>
                <input type="text" name="occupation"
                       value="{{ old('occupation', $spouse->occupation ?? '') }}"
                       class="form-control">
                <small class="error-text" id="spouse_occupation_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Visa Type</label>
                <select name="visa_type" class="form-control">
                    <option value="">Select Visa Type</option>
                    <option value="H1A" {{ old('visa_type', $spouse->visa_type ?? '')=='H1A'?'selected':'' }}>H1A</option>
                    <option value="H1B" {{ old('visa_type', $spouse->visa_type ?? '')=='H1B'?'selected':'' }}>H1B</option>
                    <option value="H4" {{ old('visa_type', $spouse->visa_type ?? '')=='H4'?'selected':'' }}>H4</option>
                    <option value="L2" {{ old('visa_type', $spouse->visa_type ?? '')=='L2'?'selected':'' }}>L2</option>
                    <option value="L1A" {{ old('visa_type', $spouse->visa_type ?? '')=='L1A'?'selected':'' }}>L1A</option>
                    <option value="L1B" {{ old('visa_type', $spouse->visa_type ?? '')=='L1B'?'selected':'' }}>L1B</option>
                    <option value="F1 OPT" {{ old('visa_type', $spouse->visa_type ?? '')=='F1 OPT'?'selected':'' }}>F1 OPT</option>
                    <option value="F1 CPT" {{ old('visa_type', $spouse->visa_type ?? '')=='F1 CPT'?'selected':'' }}>F1 CPT</option>
                    <option value="M" {{ old('visa_type', $spouse->visa_type ?? '')=='M'?'selected':'' }}>M</option>
                    <option value="J" {{ old('visa_type', $spouse->visa_type ?? '')=='J'?'selected':'' }}>J</option>
                    <option value="Q" {{ old('visa_type', $spouse->visa_type ?? '')=='Q'?'selected':'' }}>Q</option>
                    <option value="EAD" {{ old('visa_type', $spouse->visa_type ?? '')=='EAD'?'selected':'' }}>EAD</option>
                    <option value="Green Card" {{ old('visa_type', $spouse->visa_type ?? '')=='Green Card'?'selected':'' }}>Green Card</option>
                    <option value="Us Citizen" {{ old('visa_type', $spouse->visa_type ?? '')=='Us Citizen'?'selected':'' }}>Us Citizen</option>
                    <option value="Not Available" {{ old('visa_type', $spouse->visa_type ?? '')=='Not Available'?'selected':'' }}>Not Available</option>
                </select>
                <small class="error-text" id="spouse_visa_type_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>First Port Of Entry Date To USA</label>
                <input type="date" name="first_port_entry_date"
                       value="{{ old('first_port_entry_date', $spouse->first_port_entry_date ?? '') }}"
                       class="form-control">
                <small class="error-text" id="spouse_first_port_entry_date_error"></small>
            </div>
        </div>

        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-primary px-4" id="spouseSubmitBtn">Submit</button>
            <button type="reset" class="btn btn-secondary px-4">Reset</button>
        </div>

    </div>
</div>
</form>
