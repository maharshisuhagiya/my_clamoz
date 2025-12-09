@extends('layout.wrapperplain')
@section('content')

<style>
    .logged-out body #main-wrapper .login-box{
        width: 675px !important;
    }
    /* FIX: Stop hiding checkboxes */
    #signUpForm input[type=checkbox] {
        position: static !important;
        left: auto !important;
        opacity: 1 !important;
        margin-right: 6px;
        width: 16px;
        height: 16px;
    }

    #whatsapp_number_wrapper {
        display: none;
    }

    .iti {
        width: 100%;
        position: relative !important;
    }

    .iti--container {
        z-index: 99999 !important;
    }
    /* Override Country List Dropdown of intl-tel-input */
    .iti__country-list {
        white-space: normal !important;  /* Remove nowrap */
        width: 300px !important;         /* Set width */
    }
</style>

<!--signup-->
<div class="login-logo m-t-30 p-b-5">
    <a href="javascript:void(0)" class="text-center db">
        <img src="{{ runtimeLogoLarge() }}" alt="Home">
    </a>
</div>

<div class="login-box m-t-20">
    <div class="title">
        <h3 class="box-title m-t-10 text-center">{{ cleanLang(__('lang.create_new_account')) }}</h3>
        <div class="text-center m-b-20">
            <small>{{ cleanLang(__('lang.sign_up_for_your_account')) }}</small>
        </div>
    </div>

    <form class="form-horizontal form-material" id="signUpForm">

        <div class="row">

            <!-- FIRST NAME -->
            <div class="form-group col-md-4 m-t-20">
                <input class="form-control" type="text" name="first_name" id="first_name"
                    placeholder="{{ cleanLang(__('lang.first_name')) }}">
            </div>

            <!-- LAST NAME -->
            <div class="form-group col-md-4 m-t-20">
                <input class="form-control" type="text" name="last_name" id="last_name"
                    placeholder="{{ cleanLang(__('lang.last_name')) }}">
            </div>

            <!-- COMPANY -->
            <div class="form-group col-md-4 m-t-20">
                <input class="form-control" type="text" name="client_company_name"
                    id="client_company_name" placeholder="{{ cleanLang(__('lang.company_name')) }}">
            </div>

            <!-- EMAIL -->
            <div class="form-group col-md-6 m-t-20">
                <input class="form-control" type="text" name="email" id="email"
                    placeholder="{{ cleanLang(__('lang.email')) }}">
            </div>

            <!-- TIMEZONE -->
            <div class="form-group col-md-6 m-t-20">
                <select class="form-control" name="timezone" id="timezone">
                    <option value="">Select Time Zone</option>
                    <option value="CST">CST</option>
                    <option value="EST">EST</option>
                    <option value="MST">MST</option>
                    <option value="PST">PST</option>
                    <option value="IST">IST</option>
                </select>
            </div>

            <!-- PASSWORD -->
            <div class="form-group col-md-6 m-t-20">
                <input class="form-control" type="password" name="password" id="password"
                    placeholder="{{ cleanLang(__('lang.password')) }} ({{ cleanLang(__('lang.minimum_six_characters')) }})">
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="form-group col-md-6 m-t-20">
                <input class="form-control" type="password" name="password_confirmation"
                    id="password_confirmation" placeholder="{{ cleanLang(__('lang.confirm_password')) }}">
            </div>

            <div class="form-group col-md-6 m-t-20" id="contact_number_wrapper" style="overflow: visible;">
                <input type="tel" id="contact_number" name="contact_number" class="form-control"
                    placeholder="Contact Number">
            </div>

            <div class="form-group col-md-6 m-t-20" id="whatsapp_number_wrapper" style="overflow: visible; display:none;">
                <input type="tel" id="whatsapp_number" name="whatsapp_number" class="form-control"
                    placeholder="Whatsapp Number">
            </div>

            <input type="hidden" name="contact_country_code" id="contact_country_code">
            <input type="hidden" name="whatsapp_country_code" id="whatsapp_country_code">

            <!-- WHATSAPP NOT SAME -->
            <div class="form-group col-md-12 m-t-10">
                <label>
                    <input type="checkbox" id="whatsapp_not_same" name="whatsapp_not_same">
                    Is Whatsapp Number not same as Contact Number
                </label>
            </div>

            <!-- TERMS AND CONDITIONS -->
            <div class="form-group col-md-12 m-t-10">
                <label>
                    <input type="checkbox" name="accept_terms">
                    I agree and accept the <a href="#">terms and conditions</a>
                </label>
            </div>

        </div>

        <!-- BUTTON -->
        <button class="btn btn-info btn-lg btn-block" id="signupButton"
                disabled
                data-button-loading-annimation="yes" data-button-disable-on-click="yes"
                data-url="{{ url('signup') }}" data-ajax-type="POST"
                data-loading-target="" data-loading-class="loading" type="submit">
            {{ cleanLang(__('lang.sign_up')) }}
        </button>

        <!-- LOGIN LINK -->
        <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
                <p>
                    {{ cleanLang(__('lang.already_have_an_account')) }}
                    <a href="login" class="text-info m-l-5"><b>{{ cleanLang(__('lang.sign_in')) }}</b></a>
                </p>
            </div>
        </div>

    </form>
</div>

<!-- BACKGROUND IMAGES -->
<div class="login-background">
    <div class="x-left">
        <img src="{{ url('/') }}/public/images/login-1.png" class="login-images" />
    </div>
    <div class="x-right hidden">
        <img src="{{ url('/') }}/public/images/login-2.png" />
    </div>
</div>

@endsection


@section('script')
<!-- intl-tel-input LIBRARY -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const contactInput   = document.querySelector("#contact_number");
    const whatsappInput  = document.querySelector("#whatsapp_number");
    const checkbox       = document.querySelector("#whatsapp_not_same");
    const whatsappBox    = document.querySelector("#whatsapp_number_wrapper");
    const submitBtn      = document.querySelector("#signupButton");
    const termsCheckbox  = document.querySelector("input[name='accept_terms']");

    const DEFAULT_COUNTRY = "in";

    // CONTACT INPUT
    let contactIti = window.intlTelInput(contactInput, {
        separateDialCode: true,
        preferredCountries: ["in", "us", "gb"],
        initialCountry: DEFAULT_COUNTRY,
    });

    // SET DEFAULT CONTACT CODE
    updateContactCode();


    let whatsappIti = null;

    // WhatsApp number box toggle
    checkbox.addEventListener("change", function () {

        if (this.checked) {
            whatsappBox.style.display = "block";

            if (!whatsappIti) {
                whatsappIti = window.intlTelInput(whatsappInput, {
                    separateDialCode: true,
                    preferredCountries: ["in", "us", "gb"],
                    initialCountry: DEFAULT_COUNTRY,
                });
            }

            updateWhatsappCode();

        } else {
            whatsappBox.style.display = "none";
            document.querySelector("#whatsapp_country_code").value = "";
            whatsappInput.value = "";
        }
    });

    // 🔥 UPDATE ON COUNTRY CHANGE (CONTACT)
    contactInput.addEventListener("countrychange", function () {
        updateContactCode();
    });

    // 🔥 UPDATE ON COUNTRY CHANGE (WHATSAPP)
    whatsappInput.addEventListener("countrychange", function () {
        if (whatsappIti) {
            updateWhatsappCode();
        }
    });


    function updateContactCode() {
        const data = contactIti.getSelectedCountryData();
        document.querySelector("#contact_country_code").value = "+" + data.dialCode;
    }

    function updateWhatsappCode() {
        const data = whatsappIti.getSelectedCountryData();
        document.querySelector("#whatsapp_country_code").value = "+" + data.dialCode;
    }


    // ENABLE BUTTON ONLY IF TERMS CHECKED
    submitBtn.disabled = true;
    termsCheckbox.addEventListener("change", function () {
        submitBtn.disabled = !this.checked;
    });

    // On submit — set full number
    const form = document.querySelector("#signUpForm");
    form.addEventListener("submit", function () {

        // CONTACT
        updateContactCode();
        document.querySelector("#contact_number").value = contactIti.getNumber();

        // WHATSAPP
        if (whatsappIti && whatsappBox.style.display !== "none") {
            updateWhatsappCode();
            document.querySelector("#whatsapp_number").value = whatsappIti.getNumber();
        }
    });

});
</script>
@endsection
