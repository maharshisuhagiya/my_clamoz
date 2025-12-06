<div class="card shadow-sm">
    <div class="card-body">

        <h5 class="text-primary mb-3">REQUIRED INFORMATION FOR STATE</h5>

        <form id="stateForm">
            @csrf

            @php
                $stateQuestions = [
                    "If you are resident of MA State? Provide Per month rent you are paying.",
                    "If you are resident of MA State? Are you and your family covered with MA health insurance? If yes, mention the no. of months covered.",
                    "If you are resident of NJ State? Provide Per month rent you are paying.",
                    "If you are resident of IN State? Provide Per month rent you are paying.",
                    "If you are resident of WI State? Provide Per month rent you are paying.",
                    "If you are paid any education saving plan (529 plan). If yes please provide the document.",
                    "Did you file for Iowa and Oregon last year 2024? If yes upload the whole Tax Returns.",
                    "If you are resident of OH & PA for 2025? If yes please provide your Home and Work address.",
                ];
            @endphp

            @foreach($stateQuestions as $i => $q)

                @php
                    $num   = $i + 1;
                    $entry = $stateEntries[$num] ?? null;
                    $ans   = $entry->yes_no ?? "";
                    $text  = $entry->text   ?? "";
                @endphp

                <div class="mb-3">
                    <label class="fw-bold">{{ $num }}) {{ $q }}</label><br>

                    <div class="yesno-group">
                        <div class="yesno-option yes-opt {{ $ans=='Yes'?'active-yes':'' }}"
                             onclick="setYesNo('s{{ $num }}','Yes',this)">YES</div>

                        <div class="yesno-option no-opt {{ $ans=='No'?'active-no':'' }}"
                             onclick="setYesNo('s{{ $num }}','No',this)">NO</div>
                    </div>

                    <input type="hidden" name="s{{ $num }}" value="{{ $ans }}">

                    <div class="extra-input-box" id="extra_s{{ $num }}"
                         style="display: {{ $ans=='Yes'?'block':'none' }};">
                        <input type="text" name="extra_s{{ $num }}"
                               class="form-control mt-2"
                               placeholder="Please provide details..."
                               value="{{ $text }}">
                    </div>

                    <small class="error-text" id="state_s{{ $num }}_error"></small>
                </div>

            @endforeach

            <div class="text-end mt-4">
                <button type="submit" id="stateSubmitBtn" class="btn btn-primary px-4">Submit</button>
                <button type="reset" class="btn btn-secondary px-4">Reset</button>
            </div>
        </form>

    </div>
</div>
