<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailFile extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $obj;

    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->from(auth()->user()->email)
                ->subject($this->obj->subject)
                ->view('default.emails.demo')->from(auth()->user()->email,emailNameFrom('email_from_name'));
        foreach($this->obj->attachment as $key=>$value):
            $path = storage_path('reports' . DIRECTORY_SEPARATOR . $value);
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $email->attach($path, [
                'as' => $value,
                'mime'=>'application/pdf'
            ]);
        endforeach;
        return $email;
    }
}
