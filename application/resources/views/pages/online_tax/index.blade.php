@extends('layout.wrapper')

@section('content')

<style>
    .tab-section { display: none; }
    .tab-section.active { display: block; }
    .ptab-content { display: none; }
    .ptab-content.active { display: block; }
    .nav-tabs .nav-link { cursor: pointer; }
    .stab-content { display: none; }
    .stab-content.active { display: block; }
    .error-text {
        font-size: 14px !important;   /* Bigger font */
        font-weight: 600;
        color: #e63946 !important;    /* Strong red */
        margin-top: 3px;
        display: block;
    }

    .error-input {
        border: 2px solid #e63946 !important; 
        background: #ffe6e6 !important;       
    }

    .yesno-group {
        display: inline-flex;
        border: 1px solid #d1d1d1;
        border-radius: 25px;
        overflow: hidden;
    }

    .yesno-option {
        padding: 6px 20px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        border-right: 1px solid #d1d1d1;
        background: #f8f9fa;
        color: #4a4a4a;
        transition: 0.2s;
    }

    .yesno-option:last-child {
        border-right: none;
    }

    .yesno-option.active-yes {
        background: #198754 !important;
        color: #fff !important;
    }

    .yesno-option.active-no {
        background: #dc3545 !important;
        color: #fff !important;
    }

    .yesno-option:hover {
        background: #e2e6ea;
    }

    .extra-input-box {
        margin-top: 10px;
        display: none;
    }

    .list-group-item.active {
        background-color: #1586b0 !important;
        border-color: #1586b0 !important;
    }

    .btn-primary{
        background: #1586b0 !important;
    }

    .list-group-item i {
        margin-right: 8px;
        font-size: 16px;
    }
</style>

<div class="container-fluid" style="padding: 32px 13px;">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="list-group shadow-sm" id="sidebarMenu">

                <a class="list-group-item list-group-item-action active" data-tab="personal">
                    <i class="ti-user"></i> Personal Information
                </a>

                <a class="list-group-item list-group-item-action" data-tab="taxnotes">
                    <i class="ti-notepad"></i> Schedule Tax Notes
                </a>

                <a class="list-group-item list-group-item-action" data-tab="upload">
                    <i class="ti-upload"></i> Upload Documents
                </a>

                {{-- <a class="list-group-item list-group-item-action" data-tab="otherinfo">
                    <i class="ti-info-alt"></i> Other Tax Information
                </a> --}}

                <a class="list-group-item list-group-item-action" data-tab="bank">
                    <i class="ti-credit-card"></i> Bank Details
                </a>

                <a class="list-group-item list-group-item-action" data-tab="income">
                    <i class="ti-bar-chart"></i> Income Details
                </a>

                <a class="list-group-item list-group-item-action" data-tab="expenses">
                    <i class="ti-money"></i> Expenses Details
                </a>

                <a class="list-group-item list-group-item-action" data-tab="state">
                    <i class="ti-map-alt"></i> Required Information For State
                </a>

                <a class="list-group-item list-group-item-action" data-tab="summary">
                    <i class="ti-layers-alt"></i> My Tax Summary
                </a>

                <a class="list-group-item list-group-item-action" data-tab="rewards">
                    <i class="ti-gift"></i> Referral Rewards
                </a>

            </div>
        </div>

        <!-- Right Side Content -->
        <div class="col-md-9">

            <!-- Page Title -->
            <h3 id="pageTitle" class="mb-4">Personal Information</h3>

            <!-- TAB 1: Personal Info -->
            <div id="tab-personal" class="tab-section active">

                <!-- ======= TOP SUB-TABS (inside personal info) ======= -->
                <ul class="nav nav-tabs mb-4" id="personalTabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-ptab="taxpayer">Taxpayer Information »</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-ptab="spouse">Spouse Info (If Married) »</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-ptab="dependent">Dependent Information »</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-ptab="address">Address Of Living In Tax Year</a>
                    </li>
                </ul>

                <!-- ============== SUB-TAB CONTENT ============== -->
                <div id="ptab-taxpayer" class="ptab-content active">
                    @include('pages.online_tax.personal_information.taxpayer-form')
                </div>

                <div id="ptab-spouse" class="ptab-content">
                    @include('pages.online_tax.personal_information.spouse-information')
                </div>

                <div id="ptab-dependent" class="ptab-content">
                    @include('pages.online_tax.personal_information.dependents_information')
                </div>

                <div id="ptab-address" class="ptab-content">
                    @include('pages.online_tax.personal_information.address-of-living-in-tax-year')
                </div>
            </div>

            <!-- TAB 2: Coming Soon -->
            <div id="tab-taxnotes" class="tab-section">
                @include('pages.online_tax.schedule_tax_notes')
            </div>

            <div id="tab-upload" class="tab-section">
                @include('pages.online_tax.upload_documents')
            </div>

            <div id="tab-bank" class="tab-section">
                @include('pages.online_tax.tax_info.bank-details')
            </div>

            <div id="tab-income" class="tab-section">
                @include('pages.online_tax.tax_info.other-income')
            </div>

            <div id="tab-expenses" class="tab-section">
                @include('pages.online_tax.tax_info.other-expenses')
            </div>

            <div id="tab-state" class="tab-section">
                @include('pages.online_tax.tax_info.state-info')
            </div>

            {{-- <div id="tab-otherinfo" class="tab-section">

                <!-- ======= TOP SUB-TABS (inside OTHER TAX INFO) ======= -->
                <ul class="nav nav-tabs mb-4" id="otherTaxTabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-stab="bank">Bank Details »</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-stab="income">Other Income Details »</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-stab="expenses">Other Expenses Details »</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-stab="state">Required Information For State</a>
                    </li>
                </ul>

                <!-- ============== SUB TAB CONTENTS ============== -->

                <!-- BANK DETAILS -->
                <div id="stab-bank" class="stab-content active">
                    @include('pages.online_tax.tax_info.bank-details')
                </div>

                <!-- OTHER INCOME -->
                <div id="stab-income" class="stab-content">
                    @include('pages.online_tax.tax_info.other-income')
                </div>

                <!-- OTHER EXPENSES -->
                <div id="stab-expenses" class="stab-content">
                    @include('pages.online_tax.tax_info.other-expenses')
                </div>

                <!-- REQUIRED STATE INFO -->
                <div id="stab-state" class="stab-content">
                    @include('pages.online_tax.tax_info.state-info')
                </div>

            </div> --}}

            <div id="tab-summary" class="tab-section">
                @include('pages.online_tax.tax_summary')
            </div>

            <div id="tab-rewards" class="tab-section">

                <!-- TOP TOTAL REWARD CARD -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="text-primary">Total Reward Points</h4>
                        <h2 class="text-success">{{ $totalRewards }}</h2>
                    </div>
                </div>

                <!-- USER WISE REWARD BREAKDOWN -->
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h4 class="text-primary mb-3">Reward Earned From Each User</h4>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Joined</th>
                                    <th>Reward Earned</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rewardBreakdown as $key => $u)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $u->first_name }} {{ $u->last_name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ optional($u->created)->format('d M Y') }}</td>

                                    <!-- Reward per user = 50 (your system logic) -->
                                    <td class="text-success fw-bold">50</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No referred users yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection


@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // Sidebar click handler
    document.querySelectorAll('#sidebarMenu a').forEach(menu => {
        menu.addEventListener('click', function() {

            document.querySelectorAll('#sidebarMenu a').forEach(m => m.classList.remove('active'));
            this.classList.add('active');

            document.querySelectorAll('.tab-section').forEach(tab => tab.classList.remove('active'));

            let tabId = "tab-" + this.dataset.tab;
            document.getElementById(tabId).classList.add('active');

            document.getElementById("pageTitle").innerHTML = this.innerText;
        });
    });

    // SUB TABS INSIDE PERSONAL INFORMATION
    document.querySelectorAll('#personalTabs .nav-link').forEach(tab => {
        tab.addEventListener('click', function () {

            document.querySelectorAll('#personalTabs .nav-link')
                .forEach(t => t.classList.remove('active'));

            this.classList.add('active');

            document.querySelectorAll('.ptab-content')
                .forEach(c => c.classList.remove('active'));

            const id = "ptab-" + this.dataset.ptab;
            document.getElementById(id).classList.add('active');
        });
    });

    // switching other tax information tabs
    // document.querySelectorAll('#otherTaxTabs .nav-link').forEach(tab => {
    //     tab.addEventListener('click', function () {

    //         // remove active from ONLY THIS tab group
    //         document.querySelectorAll('#otherTaxTabs .nav-link')
    //             .forEach(t => t.classList.remove('active'));

    //         this.classList.add('active');

    //         // hide only content inside OTHER TAX container
    //         document.querySelectorAll('#tab-otherinfo .stab-content')
    //             .forEach(c => c.classList.remove('active'));

    //         // show only selected content
    //         const id = "stab-" + this.dataset.stab;
    //         document.querySelector(`#tab-otherinfo #${id}`).classList.add('active');
    //     });
    // });

    $("#taxpayerForm").on("submit", function(e){
        e.preventDefault();

        let form = $("#taxpayerForm");

        $("#taxpayerSubmitBtn").prop("disabled", true).text("Please wait...");

        let formData = new FormData(this);

        // REMOVE OLD ERRORS only inside taxpayerForm
        form.find(".error-text").text("");
        form.find("input, select").removeClass("error-input");

        $.ajax({
            type: "POST",
            url: "{{ route('taxpayer.save') }}",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response){

                $("#taxpayerSubmitBtn").prop("disabled", false).text("Submit");

                if(response.status === false){

                    $.each(response.errors, function(key, value){

                        // ERROR MESSAGE
                        form.find("#taxpayer_" + key + "_error").text(value[0]);

                        // RED BORDER
                        form.find("[name="+key+"]").addClass("error-input");
                    });
                } 
                else {
                    alert(response.message);

                    // UPDATE ID
                    form.find("input[name=id]").val(response.data.id);
                }
            }
        });
    });

    $("#spouseForm").on("submit", function(e){
        e.preventDefault();

        const form = $("#spouseForm");

        $("#spouseSubmitBtn").prop("disabled", true).text("Please wait...");

        let formData = new FormData(this);

        // REMOVE ONLY SPOUSE FORM ERRORS
        form.find(".error-text").text("");
        form.find("input, select").removeClass("error-input");

        $.ajax({
            type: "POST",
            url: "{{ route('spouse.save') }}",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response){
                $("#spouseSubmitBtn").prop("disabled", false).text("Submit");

                if(response.status === false){

                    $.each(response.errors, function(key, value){

                        // error span id = spouse_FIELDNAME_error
                        form.find("#spouse_" + key + "_error").text(value[0]);

                        // related input red karao
                        form.find("[name="+key+"]").addClass("error-input");
                    });

                } else {
                    alert(response.message);
                    form.find("input[name=id]").val(response.data.id);
                }
            }
        });
    });

    $("#dependentForm").on("submit", function(e){
        e.preventDefault();

        let form = $("#dependentForm");

        $("#dependentSubmitBtn").prop("disabled", true).text("Please wait...");

        let formData = new FormData(this);

        // CLEAR OLD ERRORS ONLY IN THIS FORM
        form.find(".error-text").text("");
        form.find("input, select").removeClass("error-input");

        $.ajax({
            type: "POST",
            url: "{{ route('dependent.save') }}",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response){
                $("#dependentSubmitBtn").prop("disabled", false).text("Submit");

                if(response.status === false){

                    $.each(response.errors, function(key, value){

                        // ERROR TEXT
                        form.find("#dependent_" + key + "_error").text(value[0]);

                        // RED BORDER
                        form.find("[name="+key+"]").addClass("error-input");
                    });

                } else {
                    alert(response.message);
                    form.find("input[name=id]").val(response.data.id);
                }
            }
        });
    });

    // ADD MORE BLOCK
    $("#add-more").click(function () {
        let wrapper = $("#address-wrapper");
        let clone = wrapper.find(".address-block").first().clone();

        // clear inputs
        clone.find("input, textarea, select").val("");
        clone.find(".error-text").text("");

        clone.find(".remove-address").removeClass("d-none");

        wrapper.append(clone);
    });

    // REMOVE BLOCK
    $(document).on("click", ".remove-address", function () {
        $(this).closest(".address-block").remove();
    });

    // SAVE ADDRESS FORM
    $("#addressForm").on("submit", function(e){
        e.preventDefault();

        let form = $("#addressForm");

        $("#addressSubmitBtn").prop("disabled", true).text("Please wait...");

        let formData = new FormData(this);

        form.find(".error-text").text("");
        form.find("input, textarea, select").removeClass("error-input");

        $.ajax({
            type: "POST",
            url: "{{ route('address.save') }}",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response){
                $("#addressSubmitBtn").prop("disabled", false).text("Submit");

                if(response.status === false){

                    $.each(response.errors, function(key, val){
                        $("." + key + "_error").first().text(val[0]);
                        $("[name='" + key + "[]']").addClass("error-input");
                    });

                } else {
                    alert(response.message);
                }
            }
        });
    });

    $("#taxNotesForm").on("submit", function(e){
        e.preventDefault();

        let form = $("#taxNotesForm");
        $("#taxNotesSubmitBtn").prop("disabled", true).text("Please wait...");

        let formData = new FormData(this);

        // Clear errors
        form.find(".error-text").text("");
        form.find("input, select, textarea").removeClass("error-input");

        $.ajax({
            type: "POST",
            url: "{{ route('taxnotes.save') }}",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response){
                $("#taxNotesSubmitBtn").prop("disabled", false).text("Submit");

                if(response.status === false){

                    $.each(response.errors, function(key, val){
                        $("#taxnotes_" + key + "_error").text(val[0]);
                        form.find("[name="+key+"]").addClass("error-input");
                    });

                } else {
                    alert(response.message);
                    form.find("input[name=id]").val(response.data.id);
                }
            }
        });
    });

    $("#addMoreUpload").click(function () {
        let wrapper = $("#upload-wrapper");
        let clone = wrapper.find(".upload-block").first().clone();

        clone.find("select").val("");
        clone.find("input").val("");
        clone.find(".error-text").text("");

        clone.find(".remove-block").removeClass("d-none");

        wrapper.append(clone);
    });

    $(document).on("click", ".remove-block", function () {
        $(this).closest(".upload-block").remove();
    });

    $("#uploadDocumentsForm").on("submit", function(e){
        e.preventDefault();

        let form = $("#uploadDocumentsForm");
        $("#uploadDocSubmitBtn").prop("disabled", true).text("Please wait...");

        let formData = new FormData(this);

        // clear old errors
        form.find(".error-text").text("");
        form.find("input, select").removeClass("error-input");

        $.ajax({
            type: "POST",
            url: "{{ route('upload.documents.save') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){

                $("#uploadDocSubmitBtn").prop("disabled", false).text("Upload Documents");

                if(response.status === false){

                    $.each(response.errors, function(key, msg){

                        let errorClass = key.replace(".*", "");

                        $("." + errorClass + "_error").first().text(msg[0]);

                        $("[name='"+ errorClass +"[]']").addClass("error-input");
                    });

                } else {
                    alert(response.message);
                    form.trigger("reset");
                }
            }
        });
    });

    $("#bankForm").on("submit", function(e){
        e.preventDefault();

        let form = $("#bankForm");
        $("#bankSubmitBtn").prop("disabled", true).text("Please wait...");

        let formData = new FormData(this);

        form.find(".error-text").text("");
        form.find("input, select").removeClass("error-input");

        $.ajax({
            type: "POST",
            url: "{{ route('bank.save') }}",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response){
                $("#bankSubmitBtn").prop("disabled", false).text("Submit");

                if(response.status === false){
                    $.each(response.errors, function(key, value){
                        $("#bank_" + key + "_error").text(value[0]);
                        form.find("[name="+key+"]").addClass("error-input");
                    });
                } else {
                    alert(response.message);
                }
            }
        });
    });

    $("#otherIncomeForm").on("submit", function(e){
        e.preventDefault();

        let form = $("#otherIncomeForm");
        $("#incomeSubmitBtn").prop("disabled", true).text("Please wait...");

        let formData = new FormData(this);

        $(".error-text").text("");

        $.ajax({
            type: "POST",
            url: "{{ route('income.save') }}",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response){
                $("#incomeSubmitBtn").prop("disabled", false).text("Submit");

                if(response.status === false){
                    $.each(response.errors, function(key, msg){
                        $("#income_" + key + "_error").text(msg[0]);
                    });
                }
                else {
                    alert(response.message);
                }
            }
        });
    });

    function setYesNo(field, value, element) {
        let group = element.closest(".yesno-group");

        // Hidden input update
        group.parentNode.querySelector("input[name='" + field + "']").value = value;

        // Remove old active
        group.querySelectorAll(".yesno-option").forEach(btn => {
            btn.classList.remove("active-yes", "active-no");
        });

        // Add active class
        if (value === "Yes") {
            element.classList.add("active-yes");
        } else {
            element.classList.add("active-no");
        }

        // Extra input logic
        let extraBox = document.getElementById("extra_" + field);

        if (value === "Yes") {
            extraBox.style.display = "block";
        } else {
            extraBox.style.display = "none";

            // CLEAR INPUT SAFELY
            let input = extraBox.querySelector("input");
            if (input) {
                input.value = "";
            }
        }
    }

    $("#otherExpensesForm").on("submit", function(e){
        e.preventDefault();

        let formData = new FormData(this);
        $("#expensesSubmitBtn").prop("disabled", true).text("Please wait...");
        $(".error-text").text("");

        $.ajax({
            type: "POST",
            url: "{{ route('expenses.save') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res){
                $("#expensesSubmitBtn").prop("disabled", false).text("Submit");

                if(res.status === false){
                    $.each(res.errors, (key, msg) => {
                        $("#expenses_" + key + "_error").text(msg[0]);
                    });
                } else {
                    alert(res.message);
                }
            }
        });
    });

    $("#stateForm").on("submit", function(e){
        e.preventDefault();

        $("#stateSubmitBtn").prop("disabled", true).text("Please wait...");
        let formData = new FormData(this);

        $(".error-text").text("");

        $.ajax({
            type: "POST",
            url: "{{ route('state.save') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res){

                $("#stateSubmitBtn").prop("disabled", false).text("Submit");

                if(res.status === false){
                    $.each(res.errors, (key, msg)=>{
                        $("#state_" + key + "_error").text(msg[0]);
                    });
                } else {
                    alert(res.message);
                }
            }
        });
    });
</script>
@endsection
