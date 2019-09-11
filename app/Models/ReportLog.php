<?php


namespace App\Models;


use App\Models\Fgp\Site;
use App\Models\Fgp\Volunteer;
use Illuminate\Database\Eloquent\Model;

class ReportLog extends Model
{
    protected $table='report_logs';

    protected $appends = ['total_vols', 'total_sites'];

    public function getTotalVolsAttribute() {
        return Volunteer::whereIn('id', explode(',', $this->vol_id))->count();
    }

    public function getTotalSitesAttribute() {
        return Site::whereIn('id', explode(',', $this->site_id))->count();
    }
}