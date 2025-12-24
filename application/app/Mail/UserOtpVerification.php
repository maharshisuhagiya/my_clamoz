<?php

/** --------------------------------------------------------------------------------
 * This class renders the [OTP Verification] email and stores it in the queue
 * @package    Grow CRM
 *----------------------------------------------------------------------------------*/

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class UserOtpVerification extends Mailable
{
    use Queueable;

    /**
     * The data for merging into the email
     */
    public $data;

    /**
     * Model instance
     */
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user = [], $data = [])
    {
        $this->user = $user;
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // 🔹 Load OTP email template
        if (!$template = \App\Models\EmailTemplate::where(
            'emailtemplate_name',
            'OTP Verification'
        )->first()) {
            return false;
        }

        // 🔹 Validate user model
        if (!$this->user instanceof \App\Models\User) {
            return false;
        }

        // 🔹 Only enabled templates
        if ($template->emailtemplate_status != 'enabled') {
            return false;
        }

        // 🔹 Disable client emails if system setting says so
        if (
            $this->user->type == 'client' &&
            config('system.settings_clients_disable_email_delivery') == 'enabled'
        ) {
            return;
        }

        // 🔹 Common email variables (logo, app_name, signature, footer etc.)
        $payload = config('mail.data');

        // 🔹 OTP specific variables
        $payload += [
            'first_name'        => $this->user->first_name,
            'otp'               => $this->data['otp'],
            'otp_valid_minutes' => $this->data['otp_valid_minutes'] ?? 10,
        ];

        // 🔹 Save email into queue
        $queue = new \App\Models\EmailQueue();
        $queue->emailqueue_to = $this->user->email;
        $queue->emailqueue_subject = $template->parse('subject', $payload);
        $queue->emailqueue_message = $template->parse('body', $payload);
        $queue->save();
    }
}
