<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fgp\Template;

class ClearTemporaryTemplates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'template:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->info("Removing Temporary Templates");
        $temporaryTemplates = Template::where([

            "co_no" => 2,
            "code" => "temporary_template",
            "table_name" => "temporary"

        ])
        ->get()
        ->each(function($temporary){
            $temporary->details->each(function($detail){
                $detail->items()->delete();
            });
            $temporary->details()->delete();
            $temporary->delete();
        });
        $this->info("Temporary templates cleared successfully");
    }
}
