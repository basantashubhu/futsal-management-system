<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class clearAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to clear view route cache and config';

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
        //clearing the config
        Artisan::call('config:clear');
        $this->info('Config cleared.');

        //clearing the cache
        Artisan::call('cache:clear');
        $this->info('Cache cleared.');

        //clearing the route
        Artisan::call('route:clear');
        $this->info('Route cleared.');

        //clearing the view
        Artisan::call('view:clear');
        $this->info('View cleared.');
    }
}
