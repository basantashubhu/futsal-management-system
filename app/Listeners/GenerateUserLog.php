<?php

namespace App\Listeners;

use App\Events\UserLoggedin;
use App\Lib\SessionHandler\SessionHandler;
use App\Models\UserLog;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateUserLog
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLoggedin $event
     * @return void
     */
    public function handle(UserLoggedin $event)
    {
        $session = new SessionHandler();
        $session->store($event->data, auth()->user());
    }
}
