<?php

namespace App\Mail\Email;

use App\Lib\Template\TemplateMerge;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $template;
    protected $token;
    protected $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $token, $name)
    {
        $this->token = $token;
        $this->name = $name;
        $this->template = EmailTemplate::where('temp_code', 'forgot_password')->first();
        $this->merge();
    }

    public function merge()
    {
        $data = array(
            'url' => url("password/reset/$this->token"),
            'name' => ucfirst($this->name),
        );
        $this->template = TemplateMerge::makeTemplate($this->template, $data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->view('default.emails.emailconfirmation')
            ->with([
                'template' => $this->template,
            ])->from('noreplay@zeuslogic.com', emailNameFrom('email_from_name'));
    }
}
