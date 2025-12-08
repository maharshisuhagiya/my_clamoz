<div class="card shadow-sm">
    <div class="card-body">

        <h5 class="text-primary mb-3">OTHER INCOME DETAILS</h5>

        <form id="otherIncomeForm">
            @csrf

            <!-- === QUESTION STARTS HERE === -->

            @php
                $questions = [
                    'Have you received any interest & dividend income for 2025? If yes please upload 1099-INT & DIV',
                    'Do you have any taxable refunds from state or local departments and unemployment compensation? If yes please upload 1099-G',
                    'Did you receive any business income or loss for the year 2025? If yes please upload 1099-MISC',
                    'Have you sold any Stocks in 2025? If yes please provide 1099-B document',
                    'Do you have any rental income & incurred any expenses related to that rental property?',
                    'Do you have any farm income or loss? If yes please update the information',
                    'Did you receive any social security benefits for the year 2025? If yes please upload 1099-SSA',
                    'Any other income, please specify',
                    'Do you have any gambling winnings? If yes please provide W-2G',
                    'Did you receive any income from India? If yes, please update the source documents',
                    'Have you withdrawn money from HSA? If yes please upload form 1099-SA',
                    'Have you withdrawn money from IRA? If yes please enter the amount and form 1099-R',
                    'Did you get any income or losses from royalties, partnerships, corporations & trusts etc? If yes please upload schedule K-1',
                    'Have you sold your main home? If yes please provide form 1099-S',
                    'Have you received any third party payment? If yes please provide form 1099-K',
                    'Commission received or paid?',
                    'If you sold any ESPP please provide form 3922'
                ];
            @endphp

            @foreach($questions as $i => $q)

                @php
                    $num   = $i + 1;
                    $entry = isset($otherIncomeEntries) ? $otherIncomeEntries->get($num) : null;
                    $ans   = $entry->yes_no ?? '';      // "Yes" / "No" / null
                    $text  = $entry->text   ?? '';      // extra text
                @endphp

                <div class="mb-3">
                    <label class="fw-bold">{{ $num }}) {{ $q }}</label><br>

                    <div class="yesno-group" data-target="q{{ $num }}">
                        <div class="yesno-option yes-opt
                                    {{ $ans=='Yes' ? 'active-yes' : '' }}"
                            onclick="setYesNo('q{{ $num }}','Yes', this)">
                            YES
                        </div>

                        <div class="yesno-option no-opt
                                    {{ $ans=='No' ? 'active-no' : '' }}"
                            onclick="setYesNo('q{{ $num }}','No', this)">
                            NO
                        </div>
                    </div>

                    <!-- HIDDEN VALUE (already saved answer) -->
                    <input type="hidden" name="q{{ $num }}" value="{{ $ans }}">

                    <!-- EXTRA INPUT (SHOW ONLY ON YES) -->
                    <div class="extra-input-box" id="extra_q{{ $num }}"
                        style="display: {{ $ans=='Yes' ? 'block' : 'none' }};">
                        <input type="text" name="extra_q{{ $num }}" 
                            class="form-control mt-2" 
                            placeholder="Please provide details..."
                            value="{{ $text }}">
                    </div>

                    <small class="error-text" id="income_q{{ $num }}_error"></small>
                </div>
            @endforeach

        </form>

    </div>
</div>
