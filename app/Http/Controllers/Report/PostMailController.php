<?php


namespace app\Http\Controllers\Report;

use App\Http\Controllers\BaseController;
use App\Lib\File\PDFMerger;
use App\Models\Client;
use App\Models\FileMerge as FileModel;
use App\Models\Organization;
use App\Models\ReportLog;
use App\Models\Settings\Lookups;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\File;
use App\Models\Application;
use App\Models\DeliveryMethod;

class PostMailController extends BaseController
{
    private $clayout;
    const DS = DIRECTORY_SEPARATOR;

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.reports.postMail.';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $date = date('Y-m-d');
        $applications = Application::where('is_deleted', 0)
            ->where(function ($query){
                $query->where('status', 'Approved')->orWhere('is_provider_view', 1);
            })->where('is_printed',0)->orderBy('created_at', 'desc')->limit(100)->get();
        return view($this->clayout . 'index', compact('applications'));
    }

    public function updateTable(Request $request)
    {
        $range = $request->dateRange;
        if ($range) {
            $range = explode(' - ', $range);
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:59:59', strtotime($range[1]));
            $applications = Application::whereBetween('created_at', [$start, $end])
            ->where(function ($query){
                $query->where('is_deleted', 0)->where('status', 'Approved')->orWhere('is_provider_view', 1);
            })->where('is_printed',0)->orderBy('created_at', 'desc')->get();
            foreach($applications as $app):
                $app->no_of_pets = $app->pets->count();
                $app->client_name = $app->client->fname.' '.$app->client->lname;
            endforeach;
            return $applications;
        }
    }

    public function countMail()
    {
        $data= FileModel::where('is_deleted', false)->get();
        return $data->count();
    }

    public function getGenerateLists()
    {
        return view($this->clayout.'.includes.generatedDataTable');
    }
    public function getAllLists()
    {
        $date = date('Y-m-d');
        $applications = Application::where('is_deleted', 0)
            ->where(function ($query){
                $query->where('status', 'Approved')->orWhere('is_provider_view', 1);
            })->where('is_printed',0)->orderBy('created_at', 'desc')->limit(100)->get();
        return view($this->clayout.'.includes.applicationDataTable', compact('applications'));
    }
}
