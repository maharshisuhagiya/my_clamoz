<div class="card shadow-sm">
    <div class="card-body">

        <h5 class="text-primary mb-3">BANK INFORMATION</h5>

        <form id="bankForm">
            @csrf
            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Bank Name *</label>
                    <input type="text" name="bank_name" class="form-control"
                        value="{{ $bank->bank_name ?? '' }}">
                    <small class="error-text" id="bank_bank_name_error"></small>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Bank Account Number *</label>
                    <input type="text" name="account_number" class="form-control"
                        value="{{ $bank->account_number ?? '' }}">
                    <small class="error-text" id="bank_account_number_error"></small>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Electronic Routing Number *</label>
                    <input type="text" name="routing_number" class="form-control"
                        value="{{ $bank->routing_number ?? '' }}">
                    <small class="error-text" id="bank_routing_number_error"></small>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Select Account Type *</label>
                    <select name="account_type" class="form-control">
                        <option value="">Select Account Type</option>
                        <option {{ @$bank->account_type=='Saving'?'selected':'' }}>Saving</option>
                        <option {{ @$bank->account_type=='Current'?'selected':'' }}>Current</option>
                        <option {{ @$bank->account_type=='Checking'?'selected':'' }}>Checking</option>
                    </select>
                    <small class="error-text" id="bank_account_type_error"></small>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Name of Account *</label>
                    <input type="text" name="account_holder" class="form-control"
                        value="{{ $bank->account_holder ?? '' }}">
                    <small class="error-text" id="bank_account_holder_error"></small>
                </div>

            </div>

            <div class="mt-3 text-center">
                <button type="submit" id="bankSubmitBtn" class="btn btn-primary px-4">Submit</button>
                <button type="reset" class="btn btn-secondary px-4">Reset</button>
            </div>

        </form>
    </div>
</div>
