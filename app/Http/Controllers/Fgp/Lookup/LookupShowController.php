<?php

namespace App\Http\Controllers\Fgp\Lookup;

use App\Http\Controllers\BaseController;
use App\Models\Fgp\PayPeriod;

use App\Models\Fgp\Site;
use App\Models\Fgp\StipendItem;
use App\Models\Fgp\Volunteer;
use App\Models\Settings\Lookups;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Container\RoleContainer;
use App\Models\Fgp\Template;
use Illuminate\Support\Arr;

class LookupShowController extends BaseController
{
    private $clayout;

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.settings.lookups';
    }

    // code lookup
    public function getData(Request $request)
    {
        $data = explode('/', $request->input('section'));
        $sec = array_shift($data);
        $term = array_pop($data);
        return Lookups::select('code as value', 'id')->groupBy('code')
            ->when($sec, function ($query) use ($sec) {
                $query->where('section', $sec); // filter with section
            })->when($request->term, function ($query) use ($request) {
                $query->where('code', 'like', '%' . $request->term . '%'); // select2 search
            })->when($term, function ($query) use ($term) {
                $query->where('code', 'like', '%' . $term . '%'); // lookup search
            })->get();
    }

    /**
     * Add section on fly
     */
    public function addSectionFly()
    {
        return $this->view($this->clayout . '.modal.addSectionFly');
    }

    public function searchItem(Request $request, $item)
    {
        return Lookups::select('value', 'value as id')
            ->where('section', 'volunteer')->where('code', 'like', "%$item%")
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('value', 'like', "%$term%");
            })->get();
    }

    public function getStipendType(Request $request)
    {

        return StipendItem::select('item_name as text', 'id', 'item_code')
            ->where('category', "type")
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('item_name', 'like', "%$term%");
            })
            ->get();
    }
    public function getStipendTimeType(Request $request)
    {

        $lookup = StipendItem::select('item_name as value', 'id', 'item_code')
            ->where('category', "type")
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('item_name', 'like', "%$term%");
            })
            ->get();

        return $this->responseLookup($lookup, ['value']);
    }

    public function getStipendCategory(Request $request)
    {

        return Lookups::select('value as text', 'id')
            ->where('code', 'CodeCategory')
            ->where('value', '!=', 'type')
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('value', 'like', "%$term%");
            })
            ->get();
    }

    public function getStipendItem(Request $request)
    {

        if (!request()->has('category')) {
            return;
        }

        return StipendItem::where('category', request()->category)
            ->where('is_active', 1)
            ->where('is_deleted', 0)
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('item_name', 'like', "%$term%");
            })
            ->select('item_name as text', 'id')
            ->get();
    }

    public function getStipendItemDetails(StipendItem $stipendItem)
    {

        return $stipendItem;
    }

    /* Assigned Sites */

    public function getAssignedSites(Request $request)
    {

        if (request()->has('selectedSites')) {
            $term = isset($request->term['term']) ? $request->term['term'] : [];
            $excluded_sites = json_decode($request->selectedSites, true);

            if (auth()->user()->role_id === 1) {
                return Site::where('is_deleted', 0)->select('id', 'site_name as text')
                    ->when($term, function ($query) use ($term) {
                        $query->where('site_name', 'like', "%$term%");
                    })
                    ->whereNotIn('sites.id', $excluded_sites)
                    ->get();
            }

            return auth()->user()->managerSites()->select('sites.id', 'sites.site_name as text')
                ->when($term, function ($query) use ($term) {
                    $query->where('sites.site_name', 'like', "%$term%");
                })
                ->whereNotIn('sites.id', $excluded_sites)
                ->get();
        }

        $rptMgr = auth()->user()->hierarchyIds()->all();

        if (request()->has('strictAssignedSites')) {

            $term = isset($request->term['term']) ? $request->term['term'] : null;

            $vol = request()->volunteer;

            return Volunteer::find($vol)->sites()->select('sites.id', 'sites.site_name as text')->get();

            if (auth()->user()->role_id === 1) {

                return Site::select('sites.id', 'sites.site_name as text')->with('address')
                    ->join('volunteer_sites', function ($join) use ($vol) {
                        $join->on('volunteer_sites.site_id', 'sites.id');
                        $join->on('volunteer_sites.volunteer_id', \DB::raw($vol));
                    })
                    ->when($term, function ($query) use ($term) {
                        $query->where('site_name', 'like', "%$term%");
                    })
                    ->get();
            }

            return Site::select('sites.id', 'sites.site_name as text')->with('address')
                ->whereRaw('exists (select site_id from site_managers where user_id in (' . implode(',', $rptMgr) . ') and site_id = sites.id and site_managers.is_deleted = 0)')
                ->join('volunteer_sites', function ($join) use ($vol) {
                    $join->on('volunteer_sites.site_id', 'sites.id');
                    $join->on('volunteer_sites.volunteer_id', \DB::raw($vol));
                })
                ->when($term, function ($query) use ($term) {
                    $query->where('site_name', 'like', "%$term%");
                })
                ->get();
        }

        if (in_array(auth()->user()->role_id, [1, 2, 7])) {
            return Site::where('is_deleted', 0)->select('id', 'site_name as text')
                ->when($term = $request->term, function ($query) use ($term) {
                    $query->where('site_name', 'like', "%$term%");
                })
                ->get();
        }

        return Site::select('id', 'site_name as text')->with('address')
            ->whereRaw('exists (select site_id from site_managers where user_id in (' . implode(',', $rptMgr) . ') and site_id = sites.id and site_managers.is_deleted = 0)')
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('site_name', 'like', "%$term%");
            })
            ->get();
    }

    public function getSelectiveSites(Request $request)
    {
        $selectives = explode(',', $request->data);
        $site = Site::whereIn('id', $selectives)->select('id', 'site_name as text')
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('sites.site_name', 'like', "%$term%");
            })->get();
        return $site;
    }

    public function getAssignedVolunteers(Request $request)
    {
        $excluded_vols = json_decode($request->selectedVols, true);

        $roleContainer = app(RoleContainer::class);

        if ($roleContainer->hasRole(["superAdmin", "admin", "fiscal"])) {
            return Volunteer::where('is_deleted', 0)->select(
                'id',
                DB::raw('CONCAT(first_name," ", COALESCE(middle_name,"")," ", last_name) as text')
            )
                ->when($term = $request->term, function ($query) use ($term) {
                    $query->where('first_name', 'like', "%$term%");
                })
                ->when(!is_null($excluded_vols), function ($query) use ($excluded_vols) {
                    $query->whereNotIn('volunteers.id', $excluded_vols);
                })
                ->get();
        }

        $rptMgrs = auth()->user()->getReportingMgr();

        return Volunteer::select('id', DB::raw("CONCAT(first_name,' ', COALESCE(middle_name, ''),' ', last_name) as text"))

            ->when(!is_null($excluded_vols), function ($query) use ($excluded_vols) {
                $query->whereNotIn('volunteers.id', $excluded_vols);
            })
            ->whereHas('supervisors', function ($sup) use ($rptMgrs) {
                $sup->whereIn('volunteers_supervisors.supervisor_id', $rptMgrs);
            })
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('first_name', "like", "%$term%");
            })
            ->get();
    }

    public function getGeneratedPeriods()
    {

        $periods = PayPeriod::select('period_no', 'start_date', 'end_date')->distinct()
            ->where("is_deleted", 0)
            ->where("pay_stat", '!=', "New")
            ->get()
            ->map(function ($period) {
                return [
                    "id" => $period->period_no,

                    "text" => "Period ({$period->period_no}) ... " .
                        newDate($period->start_date, 'm/d') . ' - ' .
                        newDate($period->end_date, 'm/d/y'),
                ];
            });

        return $periods;
    }

    /* Vols */

    public function getPhoneTypes(Request $request)
    {

        $types = [
            [
                "id" => "cell_phone",
                "text" => "Cell Phone",
            ],

            [
                "id" => "office_phone",
                "text" => "Office",
            ],
            [
                "id" => "tel_phone",
                "text" => "Telephone",
            ],
            [
                "id" => "home_phone",
                "text" => "Home",
            ],
        ];

        if ($selections = json_decode($request->selectedTypes, true)) {

            $types = array_filter($types, function ($type) use ($selections) {

                return !in_array($type['id'], $selections);
            });
        }

        return array_values($types);
    }

    public function fetchVolunteerIdType(Request $request)
    {

        return Lookups::select('value as text', 'id')
            ->where('code', 'vol_id_type')
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('value', 'like', "%$term%");
            })
            ->get();
    }

    public function fetchVolunteerPaymentCode(Request $request)
    {

        return Lookups::select('value as text', 'id')
            ->where('code', 'payment_code')
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('value', 'like', "%$term%");
            })
            ->get();
    }

    /* User */

    public function fetchRoles(Request $request)
    {
        return \App\Models\Role::select('label as text', 'id')
            ->when($term = $request->term, function ($q) use ($term) {
                $q->where('label', 'like', "%$term%");
            })
            ->get();
    }

    public function getVolCurrentStatus(Request $request)
    {
        return Lookups::select('value as text', 'id as id')
            ->when($term = $request->term, function ($q) use ($term) {
                $q->where('label', 'like', "% $term %");
            })
            ->where('code', 'volunteerStatus')
            ->get();
    }

    public function getVolDeactivationReason(Request $request)
    {
        return Lookups::select('value as text', 'id')
            ->when($term = $request->term, function ($q) use ($term) {
                $q->where('label', 'like', "%$term%");
            })
            ->where('code', 'volunteerDeactivationReason')
            ->get();
    }

    public function getTemplateCategories(Request $request, $volunteerID){


        $table = "volunteers";
        if(request()->has('temporary')){
            $table = "temporary";
        }

        $existingCategories = Template::where('table_name', $table)->where('table_id', $volunteerID)->pluck('category_id')->filter(function($data){
            return $data;
        })->all();
        return Lookups::select('value as text', 'id')        
        ->where('is_deleted', 0)
        ->when($term = $request->term, function ($q) use ($term) {
            $q->where('value', 'like', "%$term%");
        })
        ->where('code', "templateCategory")
        ->when($existingCategories, function($query) use($existingCategories){
            return $query->whereNotIn('id',$existingCategories);
        })
        ->get();

    }

    public function getAllTemplateCategories(Request $request){

        return Lookups::select('value as text', 'id')        
        ->where('is_deleted', 0)
        ->when($term = $request->term, function ($q) use ($term) {
            $q->where('value', 'like', "%$term%");
        })
        ->where('code', "templateCategory")        
        ->get();

    }



}
