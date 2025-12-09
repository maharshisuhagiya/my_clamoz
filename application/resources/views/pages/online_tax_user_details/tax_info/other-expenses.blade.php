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
                    'Do you make any additional contributions to H.S.A/I.R.A apart from w2?.',
                    'Do you have student loan in USA or in INDIA? If yes, please upload document 1098E or relevant Doc.',
                    'Did you pay any tuition fee for self, spouse or dependents? If yes, please upload document 1098T.',
                    'Did you itemize your returns last year? if yes please provide state refund.',
                    'Do you have any foreign bank account? If yes, have you transferred or maintained the aggregate balance of $10,000 or more? If yes, need to report FBAR.',
                    'Are you and your family covered with health insurance? If yes, mention the no. of months covered.',
                    'Health insurance was provided by Employer/Market place/self? Please mention and Upload the document sent by the provider.',
                    'Have you paid alimony in 2025? If yes please specify the amount.',
                    'Did you pay any Sales and Excise taxes on vehicle bought in 2025. If yes please upload bills.',
                    'Did you purchase any energy saving product in USA? If yes please specify it.',
                    'Have you worked with more than one employer in 2025? If Yes enter the employers details.',
                    'If you transfer more than $100,000 (MFJ) in your foreign account than you need to report FATCA along with your return .if yes please provide the information',
                    'Have you filed Last year tax return with OnlineTaxFiler',
                    'Have you purchased any Hybrid motor Vehicle in the TY 2025?',
                    'Have you applied ITIN in 2014 (with 2013 Tax Filing)?',
                    'Tax Preparation fee of last year'
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

        </form>

    </div>
</div>
