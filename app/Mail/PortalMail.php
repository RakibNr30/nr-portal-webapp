<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Cms\Entities\MailContent;
use Modules\Cms\Services\MailContentService;

class PortalMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $mailContent = MailContent::where('mail_category_id', $data['mail_category_id'])->first();
        return $this->subject($mailContent->subject)
            ->view('cms::mail.portal-mail', compact('data', 'mailContent'));
    }
}
