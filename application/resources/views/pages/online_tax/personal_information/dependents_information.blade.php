<form id="dependentForm">
@csrf
<input type="hidden" name="id" value="{{ $dependent->id ?? '' }}">

<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="mb-4">
            Dependents Information 
            <span class="text-danger" style="font-size:15px;">(Do Not Include Spouse)</span>
        </h4>

        <!-- BASIC INFO -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>First Name *</label>
                <input type="text" name="first_name" class="form-control"
                       value="{{ $dependent->first_name ?? '' }}">
                <small class="error-text" id="dependent_first_name_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Middle Name</label>
                <input type="text" name="middle_name" class="form-control"
                       value="{{ $dependent->middle_name ?? '' }}">
                <small class="error-text" id="dependent_middle_name_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Last Name *</label>
                <input type="text" name="last_name" class="form-control"
                       value="{{ $dependent->last_name ?? '' }}">
                <small class="error-text" id="dependent_last_name_error"></small>
            </div>
        </div>

        <!-- DOB & Gender -->
        <h5 class="mt-4 mb-3 text-primary">DOB & GENDER</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Date of Birth *</label>
                <input type="date" name="dob" class="form-control"
                       value="{{ $dependent->dob ?? '' }}">
                <small class="error-text" id="dependent_dob_error"></small>
            </div>

            <div class="col-md-3 mb-3">
                <label>Gender *</label>
                <select name="gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option {{ @$dependent->gender=='Male'?'selected':'' }}>Male</option>
                    <option {{ @$dependent->gender=='Female'?'selected':'' }}>Female</option>
                    <option {{ @$dependent->gender=='Other'?'selected':'' }}>Other</option>
                </select>
                <small class="error-text" id="dependent_gender_error"></small>
            </div>

            <div class="col-md-3 mb-3">
                <label>Relationship *</label>
                <input type="text" name="relationship" class="form-control"
                       value="{{ $dependent->relationship ?? '' }}">
                <small class="error-text" id="dependent_relationship_error"></small>
            </div>
        </div>

        <!-- OTHER DETAILS -->
        <h5 class="mt-4 mb-3 text-primary">OTHER DETAILS</h5>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Select Tax Id Type</label>
                <select name="tax_id_type" class="form-control">
                    <option value="">Select Tax Id Type</option>
                    <option {{ @$dependent->tax_id_type=='SSN/ITIN'?'selected':'' }}>SSN/ITIN</option>
                    <option {{ @$dependent->tax_id_type=='Applying for ITIN'?'selected':'' }}>Applying for ITIN</option>
                </select>
                <small class="error-text" id="dependent_tax_id_type_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Occupation</label>
                <input type="text" name="occupation" class="form-control"
                       value="{{ $dependent->occupation ?? '' }}">
                <small class="error-text" id="dependent_occupation_error"></small>
            </div>

           <div class="col-md-4 mb-3">
                <label>Visa Type</label>
                <select name="visa_type" class="form-control">
                    <option value="">Select Visa Type</option>

                    @php
                        $visaTypes = [
                            "H1A", "H1B", "H4", "L2", "L1A", "L1B",
                            "F1 OPT", "F1 CPT", "M", "J", "Q", "EAD",
                            "Green Card", "Us Citizen", "Not Available"
                        ];
                    @endphp

                    @foreach($visaTypes as $visa)
                        <option value="{{ $visa }}" 
                            {{ old('visa_type', @$dependent->visa_type) == $visa ? 'selected' : '' }}>
                            {{ $visa }}
                        </option>
                    @endforeach
                </select>

                <small class="error-text" id="dependent_visa_type_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>First Port Of Entry Date To USA</label>
                <input type="date" name="first_port_entry_date" class="form-control"
                       value="{{ $dependent->first_port_entry_date ?? '' }}">
                <small class="error-text" id="dependent_first_port_entry_date_error"></small>
            </div>
        </div>

        <!-- Residency Days -->
        <div class="row mt-3">

            <div class="col-md-4 mb-3">
                <label>Days Resided in USA in 2025</label>
                <input type="number" name="days_2025" class="form-control"
                       value="{{ $dependent->days_2025 ?? '' }}">
                <small class="error-text" id="dependent_days_2025_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Days Resided in USA in 2024</label>
                <input type="number" name="days_2024" class="form-control"
                       value="{{ $dependent->days_2024 ?? '' }}">
                <small class="error-text" id="dependent_days_2024_error"></small>
            </div>

            <div class="col-md-4 mb-3">
                <label>Days Resided in USA in 2023</label>
                <input type="number" name="days_2023" class="form-control"
                       value="{{ $dependent->days_2023 ?? '' }}">
                <small class="error-text" id="dependent_days_2023_error"></small>
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-4 text-center">
            <button type="submit" id="dependentSubmitBtn" class="btn btn-primary px-4">
                Submit
            </button>
            <button type="reset" class="btn btn-secondary px-4">Reset</button>
        </div>

    </div>
</div>
</form>
