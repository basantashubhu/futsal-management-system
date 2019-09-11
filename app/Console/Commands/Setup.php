<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Orangehill\Iseed\Facades\Iseed;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the project';

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

        Artisan::call('down');
        $this->info('Starting the maintenance mode...............');

        if (Schema::hasTable('developer_notes')) {
            Iseed::generateSeed('developer_notes');
            $this->info('Developers Note backup...............');
            $this->info('Start to Dumping database............');
        }

        Artisan::call('migrate:refresh');
        $this->info('Migration Complete................');
        $this->info('Start to seed the database........');

        Artisan::call('db:seed');
        $this->info('Seeding Complete................');

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

        Artisan::call('config:cache');
        $this->info('Config file Cached');

        Artisan::call('up');
        $this->info('Yeah, it\'s alive and running.');
    }
}
