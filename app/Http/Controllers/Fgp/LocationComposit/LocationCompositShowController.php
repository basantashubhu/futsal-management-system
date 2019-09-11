<?php

namespace App\Http\Controllers\Fgp\LocationComposit;

use App\Http\Controllers\BaseController;
use App\Models\Fgp\City;
use App\Models\Fgp\County;
use App\Models\Fgp\District;
use App\Models\Fgp\Region;
use App\Models\Fgp\State;
use App\Repo\BaseRepo;
use Illuminate\Http\Request;

class LocationCompositShowController extends BaseController
{
    public function __construct()
    {

        parent::__construct();

        $this->clayout = $this->layout . '.fgp.location_composit';

    }

    /*--------------- locd index page -------------*/
    public function state()
    {
        return $this->view($this->clayout . '.state.index');
    }
    public function region()
    {
        return $this->view($this->clayout . '.region.index');
    }

    public function district()
    {
        return $this->view($this->clayout . '.district.index');
    }

    public function city()
    {
        return $this->view($this->clayout . '.city.index');
    }

    public function county()
    {
        return $this->view($this->clayout . '.county.index');
    }

    /*---------- fetch all list for data table -----------*/

    public function fetchState()
    {
        return State::where('is_deleted', 0)->get();
    }

    public function fetchCity()
    {
        return City::where('is_deleted', 0)->get();
    }

    public function fetchDistrict()
    {
        return District::where('is_deleted', 0)->get();
    }

    public function fetchCounty()
    {
        return County::where('is_deleted', 0)->get();
    }

    public function fetchRegion()
    {
        return Region::where('is_deleted', 0)->get();
    }

    /*----------------- Open Model For State CRUD ------------------------*/

    public function stateAdd()
    {
        $validations = validation_value('state_create');
        return $this->view($this->clayout . '.state.modals.add', compact('validations'));
    }

    public function stateView($id)
    {
        $state = State::find($id);
        $counties = County::where('is_deleted', 0)->get();
        return $this->view($this->clayout . '.state.modals.view', compact('state', 'counties'));
    }

    public function getCountyData($state_id)
    {
        $counties = County::where('is_deleted', 0)->get();
        $state = State::find($state_id);
        return $this->view($this->clayout . '.state.table.counties', compact('counties', 'state'));
    }
    public function getCityData($state_id)
    {
        $cities = City::where('is_deleted', 0)->get();
        $state = State::find($state_id);
        return $this->view($this->clayout . '.state.table.cities', compact('cities', 'state'));
    }

    public function getRegionData($state_id)
    {
        $regions = Region::where('is_deleted', 0)->get();
        $state = State::find($state_id);
        return $this->view($this->clayout . '.state.table.region', compact('regions', 'state'));
    }
    public function getDistrictData($state_id)
    {
        $districts = District::where('is_deleted', 0)->get();
        $state = State::find($state_id);
        return $this->view($this->clayout . '.state.table.district', compact('districts', 'state'));
    }

    public function stateEdit($id)
    {
        $state = State::find($id);
        $validations = validation_value('state_create');
        return $this->view($this->clayout . '.state.modals.update', compact('state', 'validations'));
    }

    public function stateDelete($id)
    {
        return $this->view($this->clayout . '.state.modals.delete', compact('id'));

    }

    /*----------------- Open Model For Region CRUD ------------------------*/

    public function regionAdd()
    {
        $validations = validation_value('region_create');
        return $this->view($this->clayout . '.region.modals.add', compact('validations'));
    }

    public function regionEdit($id)
    {
        $region = Region::find($id);
        $validations = validation_value('region_create');
        return $this->view($this->clayout . '.region.modals.update', compact('region', 'validations'));
    }

    public function regionDelete($id)
    {
        return $this->view($this->clayout . '.region.modals.delete', compact('id'));

    }

    /*----------------- Open Model For District CRUD ------------------------*/

    public function districtAdd()
    {
        $validations = validation_value('district_create');
        return $this->view($this->clayout . '.district.modals.add', compact('validations'));
    }

    public function districtEdit($id)
    {
        $district = District::find($id);
        $validations = validation_value('district_create');
        return $this->view($this->clayout . '.district.modals.update', compact('district', 'validations'));
    }

    public function districtDelete($id)
    {
        return $this->view($this->clayout . '.district.modals.delete', compact('id'));

    }

    /*----------------- Open Model For City CRUD ------------------------*/

    public function cityAdd()
    {
        $validations = validation_value('city_create');
        return $this->view($this->clayout . '.city.modals.add', compact('validations'));
    }

    public function cityEdit($id)
    {
        $city = City::find($id);
        $validations = validation_value('city_create');
        return $this->view($this->clayout . '.city.modals.update', compact('city', 'validations'));
    }

    public function cityDelete($id)
    {
        return $this->view($this->clayout . '.city.modals.delete', compact('id'));

    }

    /*----------------- Open Model For County CRUD ------------------------*/

    public function countyAdd()
    {
        $validations = validation_value('county_create');
        return $this->view($this->clayout . '.county.modals.add', compact('validations'));
    }

    public function countyView($id)
    {

        $validations = validation_value('county_create');
        $county = County::find($id);
        $cities = City::where('is_deleted', 0)->get();
        return $this->view($this->clayout . '.county.modals.view', compact('validations', 'county', 'cities'));
    }

    public function countyEdit($id)
    {
        $county = County::find($id);
        $validations = validation_value('county_create');
        return $this->view($this->clayout . '.county.modals.update', compact('county', 'validations'));
    }

    public function countyDelete($id)
    {
        return $this->view($this->clayout . '.county.modals.delete', compact('id'));

    }

    public function getCityDatas($county)
    {
        $cities = City::where('is_deleted', 0)->get();
        $county = County::find($county);
        return $this->view($this->clayout . '.county.table.city', compact('cities', 'county'));
    }

    public function getDistrictDatas($county)
    {
        $districts = District::where('is_deleted', 0)->get();
        $county = County::find($county);
        return $this->view($this->clayout . '.county.table.district', compact('districts', 'county'));
    }

    //fetch name list
    public function getStateList($query = null)
    {

        return State::select('state_name as value', 'id')
            ->when($query, function ($param) use ($query) {
                $param->where('state_name', 'like', '%' . $query . '%');
            })
            ->get();
    }

    public function getRegionList($query = null)
    {

        return Region::select('region_name as value', 'id')
            ->when($query, function ($param) use ($query) {
                $param->where('region_name', 'like', '%' . $query . '%');
            })
            ->get();
    }
    public function getDistrictList($query = null)
    {

        return District::select('district_name as value', 'id')
            ->when($query, function ($param) use ($query) {
                $param->where('district_name', 'like', '%' . $query . '%');
            })
            ->get();
    }

    public function getCityList($query = null)
    {
        return City::select('city_name as value', 'id')
            ->when($query, function ($param) use ($query) {
                $param->where('city_name', 'like', '%' . $query . '%');
            })
            ->get();
    }

    public function getCountyList($query = null)
    {

        return County::select('county_name as value', 'id')
            ->when($query, function ($param) use ($query) {
                $param->where('county_name', 'like', '%' . $query . '%');
            })
            ->get();
    }

    public function getData(Request $requet)
    {
        $model = ucfirst(explode('/', $requet->type)[0]);
        $repo = new BaseRepo("Fgp\\{$model}");
        return $repo->execute(function ($query, $requet) {
            $params = explode('/', $requet->type);
            $query->select('id', "{$params[0]}_name as value")
                ->when(count($params) > 1 ? $params : false, function ($query, $params) {
                    $query->where("{$params[0]}_name", 'like', "%{$params[1]}%");
                })
                ->where('is_deleted', 0);
        })->get();
    }

}
