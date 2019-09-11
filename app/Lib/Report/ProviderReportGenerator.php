<?php


namespace App\Lib\Report;


use App\Models\Organization;
use Illuminate\Support\Facades\DB;

class ProviderReportGenerator
{
    protected $provider;
    protected $applications = 0;

    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    public function generateReport()
    {

    }

    protected function totalApplicaton()
    {
        return DB::table('applications')->count();
    }

    protected function allReport()
    {
        $providers = Organization::all();
        foreach ($providers as $provider):
            dd($provider);
        endforeach;
    }
}