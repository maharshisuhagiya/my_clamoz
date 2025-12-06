<form id="taxNotesForm">
@csrf
<input type="hidden" name="id" value="{{ $taxnotes->id ?? '' }}">

<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="text-primary mb-2">SCHEDULED TAX NOTES</h4>
        <p style="font-size: 14px;color:#444;">
            (please schedule your convenient time to take the additional tax information which will helps to get more benefits)
        </p>

        <div class="row mt-4">

            <!-- DATE -->
            <div class="col-md-4 mb-3">
                <label>Choose Date *</label>
                <input type="date" name="date" class="form-control" value="{{ $taxnotes->date ?? '' }}">
                <small class="error-text" id="taxnotes_date_error"></small>
            </div>

            <!-- TIME -->
            <div class="col-md-4 mb-3">
                <label>Select Time *</label>
                <select name="time" class="form-control">
                    <option value="">Select Time Slot</option>
                    <option {{ @$taxnotes->time=='09:00 AM'?'selected':'' }}>09:00 AM</option>
                    <option {{ @$taxnotes->time=='10:00 AM'?'selected':'' }}>10:00 AM</option>
                    <option {{ @$taxnotes->time=='11:00 AM'?'selected':'' }}>11:00 AM</option>
                    <option {{ @$taxnotes->time=='02:00 PM'?'selected':'' }}>02:00 PM</option>
                    <option {{ @$taxnotes->time=='03:00 PM'?'selected':'' }}>03:00 PM</option>
                </select>
                <small class="error-text" id="taxnotes_time_error"></small>
            </div>

            <!-- ZONE -->
            <div class="col-md-4 mb-3">
                <label>Select Zone *</label>
                <select name="zone" class="form-control">
                    <option value="">Select Time Zone</option>
                    <option {{ @$taxnotes->zone=='EST'?'selected':'' }}>EST</option>
                    <option {{ @$taxnotes->zone=='CST'?'selected':'' }}>CST</option>
                    <option {{ @$taxnotes->zone=='MST'?'selected':'' }}>MST</option>
                    <option {{ @$taxnotes->zone=='PST'?'selected':'' }}>PST</option>
                </select>
                <small class="error-text" id="taxnotes_zone_error"></small>
            </div>

        </div>

        <!-- QUERY -->
        <div class="row mt-2">
            <div class="col-md-12 mb-3">
                <label>Query *</label>
                <textarea name="query" class="form-control" rows="3"
                placeholder="Write your query">{{ $taxnotes->query ?? '' }}</textarea>
                <small class="error-text" id="taxnotes_query_error"></small>
            </div>
        </div>

        <div class="text-center mt-3">
            <button type="submit" id="taxNotesSubmitBtn" class="btn btn-primary px-4">Submit</button>
            <button type="reset" class="btn btn-secondary px-4">Reset</button>
        </div>

    </div>
</div>
</form>
