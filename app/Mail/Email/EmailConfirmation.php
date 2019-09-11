<?php

namespace App\Mail\Email;

use App\Lib\Generators\EmailConfirmToken;
use App\Lib\Template\TemplateMerge;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $template;
    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {

        $this->tokenGenerate($email);
        $this->template = EmailTemplate::where('temp_code', 'email_confirmation')->first();
        $this->merge();
    }

    protected function tokenGenerate($email)
    {
        $token = new EmailConfirmToken();
        $this->token = $token->GenerateToken()->savetodb($email)->getToken();
    }

    public function merge()
    {
        $data = array(
            'url' => env('APP_URL', 'http://localhost:8000').'/create/login/' . $this->token
        );
        $this->template =TemplateMerge::makeTemplate($this->template, $data);
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
            ])->from('noreplay@zeuslogic.com',emailNameFrom('email_from_name'));
    }
}
