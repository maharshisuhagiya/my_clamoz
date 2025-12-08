<form id="addressForm">
@csrf

<h4 class="text-primary mb-2">Address Of Living In Tax Year</h4>
<p class="mb-4" style="font-size: 14px; color:#555;">
    Please provide us the address/es where you lived in during the Tax Year,
    if you reside more than one state please add the boxes.
</p>

<h5 class="text-primary mb-3">Add New Address</h5>

<div id="address-wrapper">

    @if(isset($addresses) && count($addresses) > 0)
        @foreach($addresses as $a)

        <div class="address-block border-bottom pb-3 mb-4">

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Address Of *</label>
                    <select name="address_of[]" class="form-control">
                        <option value="">Select Address Of</option>
                        <option value="Tax Payer"   {{ $a->address_of=='Tax Payer'?'selected':'' }}>Tax Payer</option>
                        <option value="Spouse" {{ $a->address_of=='Spouse'?'selected':'' }}>Spouse</option>
                    </select>
                    <small class="error-text address_of_error"></small>
                </div>

                <div class="col-md-4 mb-3">
                    <label>From *</label>
                    <input type="date" name="from_date[]" value="{{ $a->from_date }}" class="form-control">
                    <small class="error-text from_date_error"></small>
                </div>

                <div class="col-md-4 mb-3">
                    <label>To *</label>
                    <input type="date" name="to_date[]" value="{{ $a->to_date }}" class="form-control">
                    <small class="error-text to_date_error"></small>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Complete Address *</label>
                    <textarea name="full_address[]" class="form-control" rows="3">{{ $a->full_address }}</textarea>
                    <small class="error-text full_address_error"></small>
                </div>

            </div>

            <button class="btn btn-danger btn-sm remove-address {{ $loop->first?'d-none':'' }}">
                ✖ Remove
            </button>

        </div>

        @endforeach

    @else

        <!-- DEFAULT EMPTY BLOCK -->
        <div class="address-block border-bottom pb-3 mb-4">

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Address Of *</label>
                    <select name="address_of[]" class="form-control">
                        <option value="">Select Address Of</option>
                        <option value="USA">USA</option>
                        <option value="India">India</option>
                        <option value="Other">Other</option>
                    </select>
                    <small class="error-text address_of_error"></small>
                </div>

                <div class="col-md-4 mb-3">
                    <label>From *</label>
                    <input type="date" name="from_date[]" class="form-control">
                    <small class="error-text from_date_error"></small>
                </div>

                <div class="col-md-4 mb-3">
                    <label>To *</label>
                    <input type="date" name="to_date[]" class="form-control">
                    <small class="error-text to_date_error"></small>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Complete Address *</label>
                    <textarea name="full_address[]" class="form-control" rows="3"></textarea>
                    <small class="error-text full_address_error"></small>
                </div>

            </div>

            <button class="btn btn-danger btn-sm remove-address d-none">
                ✖ Remove
            </button>

        </div>

    @endif

</div>

</form>
