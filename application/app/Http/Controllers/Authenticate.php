<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for authentication
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Responses\Authentication\AuthenticateResponse;
use App\Mail\ForgotPassword;
use App\Repositories\ClientRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Validator;

class Authenticate extends Controller {

    /**
     * The user repository instance.
     */
    protected $userrepo;

    /**
     * The client instance.
     */
    protected $clientrepo;

    public function __construct(
        UserRepository $userrepo,
        ClientRepository $clientrepo) {

        //parent
        parent::__construct();

        //vars
        $this->userrepo = $userrepo;
        $this->clientrepo = $clientrepo;

        //guest
        $this->middleware('guest')->except([
            'updatePassword',
        ]);

        //logged in
        $this->middleware('auth')->only([
            'updatePassword',
        ]);

        //general middleware
        $this->middleware('authenticationMiddlewareGeneral');
    }

    /**
     * Display the login form
     * @return \Illuminate\Http\Response
     */
    public function logIn() {
        //show login page
        return view('pages/authentication/login');
    }

    /**
     * Display the signup form
     * @return \Illuminate\Http\Response
     */
    public function signUp() {

        if (config('system.settings_clients_registration') == 'disabled') {
            abort(409, __('lang.this_feature_is_unavailable'));
        }
        //show login page
        return view('pages/authentication/signup');
    }

    /**
     * Display the forgot password form
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword() {
        //show login page
        return view('pages/authentication/forgotpassword');
    }

    /**
     * Display the reset password form
     * @return \Illuminate\Http\Response
     */
    public function resetPassword() {

        //1 hour expiry
        $expiry = \Carbon\Carbon::now()->subHours(1);

        //validate code
        if (\App\Models\User::Where('forgot_password_token', request('token'))
            ->where('forgot_password_token_expiry', '>=', $expiry)
            ->doesntExist()) {
            //set flass session
            request()->session()->flash('error-notification-longer', __('lang.url_expired_or_invalid'));
            //redirect
            return redirect('forgotpassword');
        }

        //show login page
        return view('pages/authentication/resetpassword');
    }

    /**
     * process login request
     * @return \Illuminate\Http\Response
     */
    public function logInAction() {

        //validate reCaptcha
        if (config('system.settings2_captcha_status') == 'enabled') {
            $validator = Validator::make(request()->all(), [
                'g-recaptcha-response' => 'recaptcha',
            ]);

            //errors
            if ($validator->fails()) {
                abort(409, __('lang.recaptcha_validation_error'));
            }
        }

        //get the user
        if (!$user = \App\Models\User::Where('email', request('email'))->first()) {
            abort(409, __('lang.invalid_login_details'));
        }

        //only client or team type contacts
        if (!in_array($user->type, ['team', 'client'])) {
            abort(409, __('lang.invalid_login_details'));
        }

        //get credentials
        $credentials = request()->only('email', 'password');
        $remember = (request('remember_me') == 'on') ? true : false;

        //check credentials
        if (Auth::attempt($credentials, $remember)) {

            // ❌ EMAIL NOT VERIFIED
            if (auth()->user()->email_verified_at === null) {

                $user = auth()->user();

                // logout immediately
                auth()->logout();

                // ⏱ OTP COOLDOWN CHECK (1–2 min)
                if ($user->otp_expires_at && now()->diffInSeconds($user->otp_expires_at, false) > -540) {
                    return response()->json([
                        'redirect_url' => url('verify-email?email=' . $user->email),
                        'message' => 'OTP already sent. Please check your email.',
                    ]);
                }

                // 🔐 Generate new OTP
                $otp = rand(100000, 999999);

                $user->update([
                    'otp'            => bcrypt($otp),
                    'otp_expires_at' => now()->addMinutes(10),
                ]);

                // 📧 Send OTP email
                $mail = new \App\Mail\UserOtpVerification($user, [
                    'otp' => $otp,
                    'otp_valid_minutes' => 10,
                ]);
                $mail->build();

                // 🔁 Redirect to verify page
                return response()->json([
                    'redirect_url' => url('verify-email?email=' . $user->email),
                    'message' => 'We have sent a new OTP to your email. Please verify to continue.',
                ]);
            }

            //if client - check if account is not suspended
            if (auth()->user()->is_client) {
                if ($client = \App\Models\Client::Where('client_id', auth()->user()->clientid)->first()) {
                    if ($client->client_status != 'active') {
                        abort(409, __('lang.account_has_been_suspended'));
                    }
                } else {
                    abort(409, __('lang.item_not_found'));
                }
            }

            //client are not allowed to login
            if (auth()->user()->is_client && config('system.settings_clients_app_login') != 'enabled') {
                abort(409, __('lang.clients_disabled_login_error'));
            }

            //if account not active
            if (auth()->user()->status != 'active') {
                auth()->logout();
                abort(409, __('lang.account_has_been_suspended'));
            }
        } else {
            //login failed message
            abort(409, __('lang.invalid_login_details'));
        }

        $payload = [
            'type' => request('action'),
        ];

        //show the form
        return new AuthenticateResponse($payload);
    }

    /**
     * process forgot password request
     * @return \Illuminate\Http\Response
     */
    public function forgotPasswordAction() {

        //validation
        if (!$user = \App\Models\User::Where('email', request('email'))->first()) {
            abort(409, __('lang.account_not_found'));
        }

        $code = Str::random(50);

        //update user - set expiry to 3 Hrs
        $user->forgot_password_token = $code;
        $user->forgot_password_token_expiry = \Carbon\Carbon::now()->addHours(3);
        $user->save();

        /** ----------------------------------------------
         * send email [comment
         * ----------------------------------------------*/
         Mail::to($user->email)->send(new ForgotPassword($user));


        //set flash session
        request()->session()->flash('success-notification-longer', __('lang.password_reset_email_sent'));

        //back to login
        $jsondata['redirect_url'] = url('login');
        return response()->json($jsondata);
    }

    /**
     * process reset password request
     * @return \Illuminate\Http\Response
     */
    public function resetPasswordAction() {

        //1 hour expiry
        $expiry = \Carbon\Carbon::now()->subHours(1);

        $messages = [];

        //validate code
        if (\App\Models\User::Where('forgot_password_token', request('token'))
            ->where('forgot_password_token_expiry', '>=', $expiry)
            ->doesntExist()) {
            //set flass session
            request()->session()->flash('error-notification-longer', __('lang.url_expired_or_invalid'));
            //back to login
            $jsondata['redirect_url'] = url('forgotpassword');
            //redirect
            return response()->json($jsondata);
        }

        //validate password match
        $validator = Validator::make(request()->all(), [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
        ], $messages);

        //errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }

        $user = \App\Models\User::Where('forgot_password_token', request('token'))->first();
        $user->password = Hash::make(request('password'));
        $user->forgot_password_token = '';
        $user->save();

        //set flass session
        request()->session()->flash('success-notification-longer', __('lang.password_reset_success'));
        //back to login
        $jsondata['redirect_url'] = url('login');
        return response()->json($jsondata);
    }

    /**
     * process new client signup action
     * @return \Illuminate\Http\Response
     */
    public function signUpAction()
    {
        //check if the feature is enabled
        if (config('system.settings_clients_registration') == 'disabled') {
            abort(409, __('lang.this_feature_is_unavailable'));
        }

        $messages = [];

        // validate
        $validator = Validator::make(request()->all(), [
            'first_name'          => 'required',
            'last_name'           => 'required',
            'client_company_name' => 'nullable',
            'password'            => 'required|confirmed|min:6',
            'email'               => 'email|required|unique:users,email',

            // NEW
            'timezone'            => 'required',
            'contact_number'      => 'required',
            'contact_country_code'   => 'required',
            'accept_terms'        => 'accepted',

            // whatsapp required only if checkbox tick
            'whatsapp_number'        => 'required_if:whatsapp_not_same,on|nullable',
            'whatsapp_country_code'  => 'required_with:whatsapp_number|nullable',

            'referral_code'       => 'nullable|exists:users,referral_code',
        ], $messages);

        if ($validator->fails()) {
            $messages = '';
            foreach ($validator->errors()->all() as $message) {
                $messages .= "<li>$message</li>";
            }
            abort(409, $messages);
        }

        //create the client
        if (!$client = $this->clientrepo->signUp()) {
            abort(409);
        }

        // referral
        $referral = request('referral_code') ?? request('ref');
        $referrer = $referral
            ? \App\Models\User::where('referral_code', $referral)->first()
            : null;

        //create user
        if (!$user = $this->userrepo->signUp($client->client_id, $referrer->id ?? 0)) {
            abort(409);
        }

        // ✅ GENERATE & SAVE UNIQUE CRN NUMBER
        $user->update([
            'crn_number' => $this->generateUniqueCrn()
        ]);

        if ($referrer) {
            \App\Models\ReferralReward::create([
                'user_id' => $referrer->id,
                'reward_value' => 50,
            ]);
        }

        // ----------- CREATE TAXPAYER ----------
        \App\Models\Taxpayer::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => request('first_name'),
                'last_name'  => request('last_name'),
                'email'      => request('email'),
                'mobile'     => request('contact_country_code') . request('contact_number'),
                'alt_mobile' => request()->filled('whatsapp_number')
                    ? request('whatsapp_country_code') . request('whatsapp_number')
                    : request('contact_country_code') . request('contact_number'),
            ]
        );

        // ✅ -------- OTP GENERATION ----------
        $otp = rand(100000, 999999);

        $user->update([
            'otp'             => bcrypt($otp),
            'otp_expires_at'  => now()->addMinutes(10),
            'email_verified_at' => null,
        ]);

        // ✅ SEND OTP EMAIL
        $mail = new \App\Mail\UserOtpVerification($user, [
            'otp' => $otp,
            'otp_valid_minutes' => 10,
        ]);
        $mail->build();

        // flash message
        request()->session()->flash(
            'success-notification-longer',
            'OTP has been sent to your email. Please verify.'
        );

        // redirect to OTP page
        return response()->json([
            'redirect_url' => url('verify-email?email=' . $user->email),
        ]);
    }
    
    private function generateUniqueCrn()
    {
        do {
            $crn = rand(10000, 99999);
        } while (\App\Models\User::where('crn_number', $crn)->exists());

        return $crn;
    }

    public function verifyEmailOtp()
    {
        request()->validate([
            'otp' => 'required|digits:6',
        ]);

        // get last registered user by email
        $user = \App\Models\User::where('email', request('email'))->first();

        if (!$user || !$user->otp) {
            abort(409, 'OTP not found.');
        }

        if (now()->gt($user->otp_expires_at)) {
            abort(409, 'OTP expired.');
        }

        if (!password_verify(request('otp'), $user->otp)) {
            abort(409, 'Invalid OTP.');
        }

        // verified
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
            'email_verified_at' => now(),
        ]);

        Auth::login($user, true);

        return response()->json([
            'redirect_url' => url('home')
        ]);
    }

    public function resendEmailOtp()
    {
        request()->validate([
            'email' => 'required|email',
        ]);

        $user = \App\Models\User::where('email', request('email'))->first();

        if (!$user) {
            abort(409, 'User not found.');
        }

        // Already verified?
        if ($user->email_verified_at) {
            abort(409, 'Email already verified.');
        }

        // Generate new OTP
        $otp = rand(100000, 999999);

        $user->update([
            'otp'            => bcrypt($otp),
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP email
        $mail = new \App\Mail\UserOtpVerification($user, [
            'otp' => $otp,
            'otp_valid_minutes' => 10,
        ]);
        $mail->build();

        return response()->json([
            'message' => 'OTP resent successfully.',
        ]);
    }

    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        //Login
        if ($section == 'login') {
            $page = [
                'meta_title' => __('lang.login_to_you_account'),
            ];
        }

        //Signup
        if ($section == 'signup') {
            $page = [
                'meta_title' => __('lang.create_a_new_account'),
            ];
        }

        //Forgot Password
        if ($section == 'forgot-password') {
            $page = [
                'meta_title' => __('lang.forgot_password'),
            ];
        }
        //return
        return $page;
    }

}