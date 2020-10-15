<?php

namespace App\Mails;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class AccountCreatedMail extends Mailable
    {
        use Queueable, SerializesModels;

        public $user;

        public function __construct($user)
        {
            $this->user = $user;
        }

        public function build()
        {
            return $this->subject(__('mail.account_created.subject'))
            ->markdown('mails/account_created', [
                'user' => $this->user,
                'name' => $this->user->username,
            ]);
        }
    }
