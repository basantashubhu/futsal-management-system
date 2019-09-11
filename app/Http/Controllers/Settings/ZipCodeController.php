<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ZipCodeRequest;
use App\Repo\ZipCodeRepo;
use App\Models\Settings\ZipCode;
use Illuminate\Support\Facades\DB;

class ZipCodeController extends BaseController
{
    private static $repo = null;
    private $clayout = "";

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.settings.zip_code';
    }

    /**
     * @param $model
     * @return ZipCodeRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null)
            self::$repo = new ZipCodeRepo($model);
        return self::$repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->clayout . '.index');
    }

    /**
     * Create Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->clayout . '.modal.add');
    }

    public function create1()
    {
        // view in single column
        return view($this->clayout . '.modal.add1');
    }

    /***
     * @param ZipCodeRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function store(ZipCodeRequest $request)
    {
        $data = $request->all();
        $data['state'] = strtoupper($data['state']);

        $res = self::getInstance('Settings\ZipCode')->saveUpdate($data);

        if ($res) {
            return $this->response("Zip Code Added SuccessFully", "view", 200);
        } else {
            return $this->response("Can't add Zip Code", 'view', 422);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getAll(Request $request)
    {
        $data = self::getInstance('Settings\ZipCode')->selectDataTable($request);
        return $data;
    }

    /**
     * Update Form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ZipCode $zip_code)
    {
        return view($this->clayout . '.modal.edit', compact('zip_code'));
    }

    public function update(ZipCodeRequest $request, ZipCode $zip_code)
    {
        $res = self::getInstance($zip_code)->saveUpdate($request);

        if ($res) {
            return $this->response("Zip Code Updated SuccessFully", "view", 200);
        } else {
            return $this->response("Can't Update Zip Code", 'view', 422);
        }
    }

    public function getData($zip_code_val, $query = false)

        //zip_code_val = City
        //ZipCode = array;
    {
        if ($zip_code_val != 'city') {
            if ($query) {
                $zipCode = ZipCode::select($zip_code_val)->where($zip_code_val, 'LIKE', $query . '%')->where('is_deleted', false)->orderBy($zip_code_val, 'asc')->distinct()->get();
            } else {
                $zipCode = ZipCode::select($zip_code_val)->where('is_deleted', false)->orderBy($zip_code_val, 'asc')->distinct()->get();
            }
        } else {
            if ($query) {
                $query = explode('-', $query);
                $zipCode = ZipCode::select('id', DB::raw("concat($zip_code_val,' - ',zip_code) as city"))->where($zip_code_val, 'LIKE', trim($query[0]) . '%')->where('is_deleted', false)->orderBy($zip_code_val, 'asc')->distinct()->get();
            } else {
                $zipCode = ZipCode::select('id', DB::raw("concat($zip_code_val,' - ',zip_code) as city"))->where('is_deleted', false)->orderBy($zip_code_val, 'asc')->distinct()->get();
            }
        }


        foreach ($zipCode as $zip):
            $zip->lookup_val = $zip->$zip_code_val;
        endforeach;

        switch ($zip_code_val) {
            case "city":
                return $this->responseLookup($zipCode, [$zip_code_val]);
                break;

            case "zip_code":
                return $this->responseLookup($zipCode, [$zip_code_val]);
                break;

            case "state":
                return $this->responseLookup($zipCode, [$zip_code_val]);
                break;

            case "county":
                return $this->responseLookup($zipCode, [$zip_code_val]);
                break;

            case "district":
                return $this->responseLookup($zipCode, [$zip_code_val]);
                break;

            default:
                // code...
                break;
        }

        return $zipCode;
    }

    public function getTypeData($zip_code_val, $value)
    {
        $zipCode = ZipCode::where($zip_code_val, 'LIKE', $value . '%')->where('is_deleted', false)->get();
        foreach ($zipCode as $zip):
            $zip->lookup_val = $zip->$zip_code_val;
        endforeach;
        return $zipCode;
    }

    public function selectall()
    {
        $zips = self::getInstance('Settings\ZipCode')->select('zip_code as value', 'city', 'county', 'state');

        return $zips;
    }

    /**
     * Get Zip Code Detai
     * @param [int] id
     * @return [object|array]
     */
    public function getDetail($id)
    {
        return ZipCode::find($id);
    }

    public function getCityDetail($cityId)
    {
        $zip = ZipCode::where('id', $cityId)->where('is_deleted', false)->get()->toArray();

        foreach ($zip as $k => &$v) {
            if ($k == "state") {
                if(is_null($v['state']))
                    $v['state']=='DE';
                else
                    $v['state'] = strtoupper($v['state']);
            }
        }
        return $zip;
    }

    public function massDelete(Request $request)
    {
        return view('default.pages.settings.zip_code.modal.massDelete');
    }

    public function generateDeletingData(Request $request)
    {
        $zips = [];
        foreach ($request->id as $id) {
            $zip = ZipCode::find($id);
            array_push($zips, $zip);
        }
        return $zips;
    }

    public function deleteAll(Request $request)
    {
        foreach ($request->id as $id) {
            $zip = ZipCode::find($id);
            $zip->is_deleted = true;
            $zip->save();
        }
        return $this->response('Zip Codes Deleted SuccessFully', 'view', 200);
    }

    public function getCity()
    {
        $city = ZipCode::where('is_deleted', false)->limit(10)->get();
        return view('default.pages.settings.zip_code.modal.city', compact('city'));
    }
}
