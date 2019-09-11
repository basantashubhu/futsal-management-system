<?php

namespace App\Mail;

use App\Lib\Template\TemplateMerge;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    private $template;

    /**
     * ApplicationApproved constructor.
     * @param $data
     * @param $attachment
     */
    public function __construct($data)
    {
        $this->data = $data;
        if ($temp = EmailTemplate::where('temp_code', 'user_created')->first()) {
            $this->template = $temp;
        } else {
           throw  new \Exception('Template Not Found in the email_templates table with name "user_created"');
        }

        $this->merge();
    }

    public function merge()
    {
        $this->template = TemplateMerge::makeTemplate($this->template, $this->data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('default.emails.statusChange')
            ->with([
                'template' => $this->template,
            ])->from('noreplay@zeuslogic.com',emailNameFrom('email_from_name'));
        return $email;
    }
}
