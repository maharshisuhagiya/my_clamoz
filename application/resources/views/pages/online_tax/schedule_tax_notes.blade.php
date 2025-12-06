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

                @php
                    $timeSlots = [
                        "5:30 AM","6:00 AM","6:30 AM","7:00 AM","7:30 AM",
                        "8:00 AM","8:30 AM","9:00 AM","9:30 AM",
                        "10:00 AM","10:30 AM","11:00 AM","11:30 AM",
                        "12:00 PM","12:30 PM","1:00 PM","1:30 PM",
                        "2:00 PM","2:30 PM","3:00 PM","3:30 PM",
                        "4:00 PM","4:30 PM","5:00 PM","5:30 PM",
                        "6:00 PM","6:30 PM","7:00 PM","7:30 PM",
                        "8:00 PM","8:30 PM","9:00 PM","9:30 PM",
                        "10:00 PM","10:30 PM","11:00 PM","11:30 PM"
                    ];
                @endphp

                <select name="time" class="form-control">
                    <option value="">Select Time Slot</option>

                    @foreach($timeSlots as $slot)
                        <option value="{{ $slot }}"
                            {{ old('time', @$taxnotes->time) == $slot ? 'selected' : '' }}>
                            {{ $slot }}
                        </option>
                    @endforeach
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
                    <option {{ @$taxnotes->zone=='IST'?'selected':'' }}>IST</option>
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
