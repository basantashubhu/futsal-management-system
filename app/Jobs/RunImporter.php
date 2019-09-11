<?php

namespace App\Jobs;

use App\Http\Controllers\Importer\ApplicationImportController;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class RunImporter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $table;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($table)
    {
        $this->table=$table;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $imp=new ApplicationImportController();
        $imp->loadDataInOrgTable($this->table);
    }

    public function send()
    {
        Log::info("Request Cycle with Queues Begins");
        $this->dispatch()->delay(now()->addMinutes(1));
        Log::info("Request Cycle with Queues Ends");
    }
}
