<?php

namespace App\Console\Commands;

use App\Lib\SessionHandler\SessionHandler;
use Illuminate\Console\Command;

class ClearSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean Up Session InActive for more than 30 mins';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Cleaning Up Session.');
        $session = new SessionHandler();
        $session->cleanUpSessions();
        $this->info('Cleaned Up Session!');
    }
}
