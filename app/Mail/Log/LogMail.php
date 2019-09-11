<?php



namespace App\Mail\Log;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $row_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($row_data)
    {
        $this->row_data = $row_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*return $this
            ->from('error@error.com')
            ->subject('Error')
            ->view('emails.log.error');*/
    }
}
