<?php


namespace App\Http\Controllers\Settings;

use App\Http\Controllers\BaseController;
use App\Http\Requests\LookupRequest;
use App\Models\Fgp\County;
use App\Models\Fgp\Section;
use App\Models\Settings\Lookups;
use App\Models\User;
use App\Repo\LookupRepo;
use Illuminate\Http\Request;

class LookupsController extends BaseController
{
    private static $repo = null;
    private $clayout = "";

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.settings.lookups';
    }

    /**
     * @param $model
     * @return LookupRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null) {
            self::$repo = new LookupRepo($model);
        }

        return self::$repo;
    }

    function list(Request $request) {
        $selectCol = $request->has('lookupview') ? 'value' : 'text';
        $data = $request->has('lookupview') ? $request->input('lookupview') : '';
        $data = explode('/', $data);
        $term = isset($data[1]) ? $data[1] : $request->term;

        return app(Section::class)->select('id', 'section as ' . $selectCol)
            ->when($term, function ($query) use ($term) {
                $query->where('section', 'like', '%' . $term . '%');
            })->get();
        /*
     * SECTION ARE FETCHING FROM sections table
     * return Lookups::select('section as '. $selectCol, 'id')->groupBy('section')
    ->when($request->term, function($query) use($request){
    $query->where('section', 'like', '%'. $request->term .'%');
    })->get();
     */
    }

    public function volunterDetail(Request $request)
    {
        $input = $request->input('formdata', array());
        $codes = array();
        foreach ($input as $key => $value) {
            $codes[] = $value['value'];
        }
        return Lookups::where('code', 'volunteer_details')
            ->select('value as text', 'id', 'datatype as data_type', 'has_lookup')
            ->when($request->term, function ($query) use ($request) {
                $query->where('value', 'like', '%' . $request->term . '%');
            })
            ->whereNotIn('value', $codes)
            ->get();
    }

    public function fetchChildLookups(Request $request)
    {
        $value_code = str_replace('"', '', str_replace(' ', '_', mb_strtolower(request()->value)));
        return Lookups::where('code', $value_code)
            ->select('value as text', 'id')
            ->when($request->term, function ($query) use ($request) {
                $query->where('value', 'like', '%' . $request->term . '%');
            })
            ->get();
    }

    public function fetchSupervisors(Request $request)
    {
        return User::select('name as text', 'id')
            ->when($request->term, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->term . '%');
            })
            ->get();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lookups = app()->make(Section::class)->get();
        $lookup_sections = Lookups::select('section', 'id')->groupBy('section')->get();
        $lookups = $lookups->merge($lookup_sections);
        $sections = $lookups->pluck('section')->merge($lookup_sections->pluck('section'))->unique();
        $section = isset($sections[0]) ? $sections[0] : false;

        $sections = $sections->filter(function ($val) {
            return !!$val;
        });
        if ($section === false) {
            return $this->response('Sections are not configured.', 'message', 500);
        }

        $codes = Lookups::where('section', $section)->groupBy('code')->get();
        return view($this->clayout . '.index', compact('codes', 'section', 'lookups', 'sections'));
    }

    public function singleView($id)
    {
        $section = app()->make(Section::class)->find($id);
        if (!$section) {
            $section = app()->make(Lookups::class)->find($id);
        }

        $section = $section->section ?? 'nosec';
        return view($this->clayout . '.includes.singleLookup', compact('section'));
    }

    public function addValue($id)
    {
        $section = app()->make(Section::class);
        $all_sections = $section->select('section')->distinct()->orderBy('section')->get();
        $section = $section->find($id)->section;
        return view($this->clayout . '.modal.add', compact('section', 'code', 'id', 'all_sections'));
    }
    public function addCode($section)
    {
        return view($this->clayout . '.modal.add', compact('section'));
    }
    /**
     * Create Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->clayout . '.modal.add', array(
            'all_sections' => Lookups::select('section')->distinct()->orderBy('section')->get(),
        ));
    }

    /**
     * @param LookupRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(LookupRequest $request)
    {
        $request->merge(['has_lookup' => $request->input('has_lookup', '0')]);
        $res = self::getInstance('Settings\Lookups')->saveUpdate($request);

        if ($res) {
            return $this->response($res, "view", 200);
        } else {
            return $this->response("Can't Add Lookup", 'view', 422);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getAll(Request $request)
    {
        $data = self::getInstance('Settings\Lookups')->selectDataTable($request);
        return $data;
    }

    /**
     * Update Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Lookups $lookup)
    {
        $all_sections = Lookups::select('section')->distinct()->orderBy('section')->get();
        return view($this->clayout . '.modal.edit', compact('lookup', 'all_sections'));
    }

    public function update(Request $request, Lookups $lookup)
    {
        $request->merge(['has_lookup' => $request->input('has_lookup', '0')]);
        $res = self::getInstance($lookup)->saveUpdate($request);

        if ($res) {
            return $this->response("Lookup Updated SuccessFully", "view", 200);
        } else {
            return $this->response("Can't Update Lookup", 'view', 422);
        }
    }

    public function getData($lookup_val)
    {
        // dd($lookup_val);
        $lookups = Lookups::where('code', $lookup_val)
            ->where('is_deleted', false)
            ->get();
        return $this->responseLookup($lookups, ['value']);
    }

    public function getTimeType(Request $request)
    {
        $lookups = StipendItem::select('item_name as text', 'id')
            ->where('category', "type")
            ->where('is_active', 1)
            ->when($term = $request->term, function ($query) use ($term) {
                $query->where('value', 'like', "%$term%");
            })
            ->get();
        return $this->responseLookup($lookups, ['item_name']);
    }

    public function getCode()
    {
        $lookups = Lookups::select('code')->where('is_deleted', false)->get();
        foreach ($lookups as $lookup) {
            $lookup->value = $lookup->code;
        }
        return $lookups;
    }

    public function getTypeData($lookup_val, $value)
    {
        $lookups = Lookups::where('code', $lookup_val)->where('value', 'LIKE', $value . '%')->where('is_deleted', false)->get();
        return $this->responseLookup($lookups, ['value']);
    }

    public function viewCode($code)
    {
        $title = explode('_', $code);
        $header = '';
        foreach ($title as $t) {
            $header = $header . ucfirst($t) . ' ';
        }
        $lookups = Lookups::where('code', $code)->where('is_deleted', false)->get();
        return view($this->clayout . '.modal.view', compact('lookups', 'code', 'header'));
    }

    public function getSpecifiesData(Request $request, $code)
    {
        return self::getInstance('Settings\Lookups')->selectSpecifiedCode($request, $code);
    }

    /**
     * Create Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createCode($code)
    {
        $all_sections = Lookups::select('section')->distinct()->orderBy('section')->get();
        return view($this->clayout . '.modal.addCode', compact('code', 'all_sections'));
    }

    public function delete(Lookups $lookup)
    {
        return view($this->clayout . '.modal.delete', compact('lookup'));
    }

    public function destroy(Request $request, Lookups $lookup)
    {
        $lookup->is_deleted = true;
        $lookup->save();
        return $this->response("Lookup Deleted SuccessFully", "view", 200);
    }

    public function countyList(Request $request)
    {
        return County::select('county_name as text')
            ->where('county_name', 'like', "%{$request->term}%")
            ->get();
    }
}
