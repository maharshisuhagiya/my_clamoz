@extends('layout.wrapperplain')

@section('content')

<div class="login-logo m-t-40">
    <img src="{{ runtimeLogoLarge() }}" alt="Logo">
</div>

<div class="login-box m-t-20">
    <div class="title text-center">
        <h3>Email Verification</h3>
        <p class="text-muted">Enter the 6-digit OTP sent to your email</p>
    </div>

    <form id="otpVerifyForm" class="form-material">

        <div class="form-group m-t-30">
            <input type="text"
                   name="otp"
                   id="otp"
                   maxlength="6"
                   class="form-control text-center"
                   placeholder="Enter OTP"
                   style="letter-spacing:8px;font-size:20px;">
        </div>

        <!-- OPTIONAL: hidden email -->
        <input type="hidden" name="email" value="{{ request('email') }}">

        <p>Notes</p>
        <ul>
            <li>
                Due to a technical issue, our emails may occasionally be delivered to your spam folder. Kindly check your spam folder.
            </li>
            <li>
                Please allow up to 30 seconds for the OTP to be delivered.
            </li>
        </ul>

        <button class="btn btn-info btn-lg btn-block m-t-20"
                data-url="{{ url('verify-email') }}"
                data-ajax-type="POST"
                data-loading-class="loading"
                type="submit">
            Verify OTP
        </button>

        <div class="text-center m-t-15">
            <a href="javascript:void(0)" id="resendOtp">Resend OTP</a>
        </div>

    </form>
</div>

@endsection


@section('script')
<script>
document.getElementById('otpVerifyForm').addEventListener('submit', function (e) {
    e.preventDefault();

    let form = this;
    let url  = form.querySelector('button').getAttribute('data-url');

    fetch(url, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },
        body: new FormData(form)
    })
    .then(res => res.json())
    .then(data => {
        if (data.redirect_url) {
            window.location.href = data.redirect_url;
        }
    })
    .catch(err => {
        alert('Invalid or expired OTP');
    });
});

document.getElementById('resendOtp').addEventListener('click', function () {

    fetch("{{ url('resend-email-otp') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },
        body: new FormData(document.getElementById('otpVerifyForm'))
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || 'OTP resent successfully');
    })
    .catch(err => {
        alert('Unable to resend OTP. Try again later.');
    });

});
</script>
@endsection
