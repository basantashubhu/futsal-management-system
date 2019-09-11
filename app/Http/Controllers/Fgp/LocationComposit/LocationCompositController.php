<?php

namespace App\Http\Controllers\Fgp\LocationComposit;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Fgp\LocationComposit\CityRequest;
use App\Http\Requests\Fgp\LocationComposit\CountyRequest;
use App\Http\Requests\Fgp\LocationComposit\DistrictRequest;
use App\Http\Requests\Fgp\LocationComposit\RegionRequest;
use App\Http\Requests\Fgp\LocationComposit\StateRequest;
use App\Models\Fgp\City;
use App\Models\Fgp\County;
use App\Models\Fgp\District;
use App\Models\Fgp\Region;
use App\Models\Fgp\State;
use App\Repo\FGP\LocationComposit\CityRepo;
use App\Repo\FGP\LocationComposit\CountyRepo;
use App\Repo\FGP\LocationComposit\DistrictRepo;
use App\Repo\FGP\LocationComposit\RegionRepo;
use App\Repo\FGP\LocationComposit\StateRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationCompositController extends BaseController
{

    private static $repo;

    public function __construct(){

        parent::__construct();

        $this->clayout = $this->layout.'.fgp.location_composit';

    }
    public static function getStateRepo($model){
        self::$repo = new StateRepo($model);
        return self::$repo;
    }

    public static function getRegionRepo($model){
        self::$repo = new RegionRepo($model);
        return self::$repo;
    }

    public static function getDistrictRepo($model){
        self::$repo = new DistrictRepo($model);
        return self::$repo;
    }

    public static function getCityRepo($model){
        self::$repo = new CityRepo($model);
        return self::$repo;
    }

    public static function getCountyRepo($model){
        self::$repo = new CountyRepo($model);
        return self::$repo;
    }
    /*------------ store and update ---------*/
    public function stateStore(StateRequest $request, State $state=null){

        if ($state):
            $update =  self::getStateRepo($state)->saveUpdate($request->all());
            if ($update):
                return $this->response('State Updated','view','200');
            else:
                return $this->response('Failed to Update','view','500');
            endif;
        else:
            $save = self::getStateRepo('Fgp\State')->saveUpdate($request->all());
            if ($save):
                return $this->response('State Successfully Added','view','200');
            else:
                return $this->response('Failed to Add state','view','500');
            endif;
        endif;
    }

    //delete State
    public function deleteState(Request $request){
        $deleted = State::find($request->id)
            ->update([
                'is_deleted'=>1,
                'useru_id' => $request->userd_id
            ]);
        if ($deleted) :
            return $this->response('Deleted','view','200');
        else:
            return $this->response('Failed to Delete','view','500');
        endif;

    }


    /*------------ Region store and update ---------*/
    public function regionStore(RegionRequest $request, Region $region = null){


        if ($region):
            $update =  self::getRegionRepo($region)->saveUpdate($request->all());
            if ($update):
                return $this->response('Region Updated','view','200');
            else:
                return $this->response('Failed to Update','view','500');
            endif;
        else:
            $save = self::getRegionRepo('Fgp\Region')->saveUpdate($request->all());
            if ($save):
                return $this->response('Region Successfully Added','view','200');
            else:
                return $this->response('Failed to Add state','view','500');
            endif;
        endif;
    }

    //delete State
    public function deleteRegion(Request $request){
        $deleted = Region::find($request->id)
            ->update([
                'is_deleted'=>1,
                'useru_id' => $request->userd_id
            ]);
        if ($deleted) :
            return $this->response('Deleted','view','200');
        else:
            return $this->response('Failed to Delete','view','500');
        endif;

    }

    /*------------ District store and update ---------*/
    public function districtStore(DistrictRequest $request, District $district = null){


        if ($district):
            $update =  self::getDistrictRepo($district)->saveUpdate($request->all());
            if ($update):
                return $this->response('District Updated','view','200');
            else:
                return $this->response('Failed to Update','view','500');
            endif;
        else:
            $save = self::getDistrictRepo('Fgp\District')->saveUpdate($request->all());
            if ($save):
                return $this->response('District Successfully Added','view','200');
            else:
                return $this->response('Failed to add District','view','500');
            endif;
        endif;
    }

    //delete district
    public function deleteDistrict(Request $request){
        $deleted = District::find($request->id)
            ->update([
                'is_deleted'=>1,
                'useru_id' => $request->userd_id
            ]);
        if ($deleted) :
            return $this->response('Deleted','view','200');
        else:
            return $this->response('Failed to Delete','view','500');
        endif;

    }


    /*------------ City store and update ---------*/
    public function cityStore(CityRequest $request, City $city = null){


        if ($city):
            $update =  self::getCityRepo($city)->saveUpdate($request->all());
            if ($update):
                return $this->response('City Updated','view','200');
            else:
                return $this->response('Failed to Update','view','500');
            endif;
        else:
            $save = self::getCityRepo('Fgp\City')->saveUpdate($request->all());
            if ($save):
                return $this->response('City Successfully Added','view','200');
            else:
                return $this->response('Failed to Add City','view','500');
            endif;
        endif;
    }

    //delete City
    public function deleteCity(Request $request){
        $deleted = City::find($request->id)
            ->update([
                'is_deleted'=>1,
                'useru_id' => $request->userd_id
            ]);
        if ($deleted) :
            return $this->response('Deleted','view','200');
        else:
            return $this->response('Failed to Delete','view','500');
        endif;

    }

    /*------------ County store and update ---------*/
    public function CountyStore(CountyRequest $request, County $county = null){


        if ($county):
            $update =  self::getCountyRepo($county)->saveUpdate($request->all());
            if ($update):
                return $this->response('County Updated','view','200');
            else:
                return $this->response('Failed to Update','view','500');
            endif;
        else:
            $save = self::getCountyRepo('Fgp\County')->saveUpdate($request->all());
            if ($save):
                return $this->response('County Successfully Added','view','200');
            else:
                return $this->response('Failed to Add County','view','500');
            endif;
        endif;
    }

    //delete City
    public function deleteCounty(Request $request){
        $deleted = County::find($request->id)
            ->update([
                'is_deleted'=>1,
                'useru_id' => $request->userd_id
            ]);
        if ($deleted) :
            return $this->response('Deleted','view','200');
        else:
            return $this->response('Failed to Delete','view','500');
        endif;

    }

    /*============ state child update ===========*/
    public function childState(Request $request){
        $state_id = $request->state_id;
       if ($request->has('cities')){
           $selectedCities = $request->cities;
           $cities = City::where('state_id',$state_id)
               ->where('is_deleted',0)
               ->get();

           if (sizeof($cities) == 0 || sizeof($selectedCities) > sizeof($cities)){
               try{
                   foreach ($selectedCities as $city){
                       City::where('id',$city)
                           ->update(['state_id'=>$state_id]);
                   }
                   return $this->response('Cities Successfully Updated','view','200');
               }catch (\Exception $e){
                   return $e->getMessage();
               }
           }else{
               try{
                    foreach ($cities as $tableCity){
                        if (in_array($tableCity->id,$selectedCities)){
                            City::where('id',$tableCity->id)
                                ->update(['state_id'=>$state_id]);
                        }
                        else{
                            City::where('id',$tableCity->id)
                                ->update(['state_id'=>null]);
                        }
                    }
                   return $this->response('Cities Successfully Updated','view','200');
               }catch (\Exception $e){
                   return $e->getMessage();
               }
           }

       }else if($request->has('counties')){
            $selectedCounties = $request->counties;
            $counties = County::where('state_id',$state_id)->where('is_deleted',0)->get();
            if (sizeof($counties) == 0 || sizeof($selectedCounties) > sizeof($counties)){
                foreach ($selectedCounties as $county){
                        County::where('id',$county)
                        ->update(['state_id'=>$state_id]);
                }
                return $this->response('Counties Successfully Updated','view','200');
            }else{
                try{
                    foreach ($counties as $county){
                        if (in_array($county->id,$selectedCounties)){
                            County::where('id',$county->id)->update(['state_id'=>$state_id]);
                        }else{
                            County::where('id',$county->id)->update(['state_id'=>null]);
                        }
                    }
                    return $this->response('Counties Successfully Updated','view','200');
                }catch (\Exception $e){
                    $e->getMessage();
                }
            }
       }
    }

    /*============== county child update ==========*/
    public function childCounty(Request $request){

        $county_id = $request->county_id;
        if ($request->has('cities')){
            $selectedCities = $request->cities;
            $cities = City::where('county_id',$county_id)->where('is_deleted',0)->get();
            if (sizeof($cities) == 0 || sizeof($selectedCities)> sizeof($cities)){
                try{
                    foreach ($selectedCities as $city){

                        City::where('id',$city)
                            ->update(['county_id'=>$county_id]);
                    }
                    return $this->response('Cities Successfully Updated','view','200');
                }catch (\Exception $e){
                    return $e->getMessage();
                }
            }else{
                try{
                    foreach ($cities as $tableCity){

                        if (in_array($tableCity->id,$selectedCities)){
                            City::where('id',$tableCity->id)
                                ->update(['county_id'=>$county_id]);
                        }
                        else{
                            City::where('id',$tableCity->id)
                                ->update(['county_id'=>null]);
                        }
                    }
                    return $this->response('Cities Successfully Updated','view','200');
                }catch (\Exception $e){
                    return $e->getMessage();
                }
            }
        }else if($request->has('districts')){
            $selectedDistricts = $request->districts;
            $districts = District::where('is_deleted',0)->get();
//            try{
//                foreach ($districts as $tableDistrict) {
//                    if (in_array($tableDistrict->id,$selectedDistricts)){
//                        District::where('id',$tableDistrict->id)
//                            ->update(['county_id'=>$county_id]);
//                    }else{
//                        District::where('id',$tableDistrict->id)
//                            ->update(['county_id'=>null]);
//                    }
//                }
//                return $this->response('District Successfully Updated','view','200');
//            }catch (\Exception $e){
//                $e->getMessage();
//            }
        }
    }

}
