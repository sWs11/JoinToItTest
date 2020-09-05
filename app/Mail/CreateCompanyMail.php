<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateCompanyMail extends Mailable
{
    use Queueable, SerializesModels;

    private $company_name;
    /**
     * Create a new message instance.
     *
     * @param string $company_name
     */
    public function __construct(string $company_name)
    {
        $this->company_name = $company_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('mail@example.com', 'JoinToIt Test Task')
            ->subject('Company Registered')
            ->markdown('mails.create_company')
            ->with([
                'company_name' => $this->company_name,
            ]);
//        return $this->view('view.name');
    }
}
