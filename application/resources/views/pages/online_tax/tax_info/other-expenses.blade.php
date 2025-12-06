<div class="card shadow-sm">
    <div class="card-body">

        <h5 class="text-primary mb-3">OTHER EXPENSES DETAILS</h5>

        <form id="otherExpensesForm">
            @csrf

            @php
                $expenses = [
                    'Do you have any medical expenses? If yes, please give details.',
                    'Do you have a Home Mortgage Interest in US or India? If yes, please give details.',
                    'Did you make any charitable contributions? If yes, please give details.',
                    'Did you make any additional contributions to HSA/M.E.R.A. apart from W2?',
                    'Do you have any student loan in USA or in India? If yes, please upload 1098E or relevant Doc.',
                    'Did you pay any tuition fee for self, spouse or dependents? If yes upload document 1098T.',
                    'Did you itemize your returns last year? If yes please provide state refund.',
                    'Do you have any foreign bank account? If yes, have you transferred or maintained more than $10,000? If yes report FBAR.',
                    'Are you and your family covered with health insurance? If yes, mention the number of months covered.',
                    'Health insurance provided by employer/marketplace? Upload the document.',
                    'Have you paid alimony in 2025? If yes please specify.',
                    'Did you pay any sales/excise tax on vehicle in 2025? If yes upload bills.',
                    'Did you purchase any energy saving product in USA? If yes specify.',
                    'Have you worked more than one employer in 2025? If yes enter employer details.',
                    'If you transfer more than $100,000 from India then FATCA filing required.',
                    'Have you filed last year tax return with OnlineTaxFiler?',
                    'Have you purchased hybrid/motor vehicle in the tax year?',
                    'Have you applied ITIN in 2014 with 2013 tax filing?',
                    'Tax Preparation fee of last year?'
                ];
            @endphp

            @foreach($expenses as $i => $q)

                @php
                    $num   = $i + 1;
                    $entry = isset($otherExpenseEntries) ? $otherExpenseEntries->get($num) : null;
                    $ans   = $entry->yes_no ?? '';
                    $text  = $entry->text   ?? '';
                @endphp

                <div class="mb-3">
                    <label class="fw-bold">{{ $num }}) {{ $q }}</label><br>

                    <div class="yesno-group">
                        <div class="yesno-option yes-opt {{ $ans=='Yes'?'active-yes':'' }}"
                             onclick="setYesNo('ex{{ $num }}','Yes',this)">
                            YES
                        </div>

                        <div class="yesno-option no-opt {{ $ans=='No'?'active-no':'' }}"
                             onclick="setYesNo('ex{{ $num }}','No',this)">
                            NO
                        </div>
                    </div>

                    <input type="hidden" name="ex{{ $num }}" value="{{ $ans }}">

                    <!-- Extra input -->
                    <div class="extra-input-box" id="extra_ex{{ $num }}"
                         style="display: {{ $ans=='Yes'?'block':'none' }};">
                        <input type="text" name="extra_ex{{ $num }}"
                               class="form-control mt-2"
                               placeholder="Please provide details..."
                               value="{{ $text }}">
                    </div>

                    <small class="error-text" id="expenses_ex{{ $num }}_error"></small>
                </div>

            @endforeach

            <div class="text-end mt-4">
                <button type="submit" id="expensesSubmitBtn" class="btn btn-primary px-4">Submit</button>
            </div>

        </form>

    </div>
</div>
