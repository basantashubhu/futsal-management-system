<?php

namespace App\Http\Controllers\Fgp\Location;

use App\Http\Controllers\BaseController;
use App\Models\Fgp\City;
use App\Models\Fgp\State;
use App\Models\Settings\ZipCode;
use Illuminate\Http\Request;
use App\Repo\FGP\LocationRepo;

class LocationController extends BaseController
{   
	private static $repo;

	public function __construct(){

		parent::__construct();

		$this->clayout = $this->layout.'.fgp.locations';

	}

	private static function getRepo($model){

		self::$repo = new LocationRepo($model);

		return self::$repo;

	}

	public function __invoke(){

		return $this->view($this->clayout.'.index');

	}

	public function tableData(Request $request)
	{

		$location = self::getRepo('Settings\ZipCode')->selectDataTable($request);
		return $location;
	}

	public function addLocation(){

		return view($this->clayout.".modal.add");

	}

	public function store(Request $request){

		if(request()->has('location_id')){

			$this->update($request);

			return response()->json(['message' => "Location updated!"], 200);
		}

		$this->create($request);

		return response()->json(['message' => 'Location created'], 200);

	}

	public function create(Request $request){

		$data = $this->bulkFormatter($request->all());

		foreach ($data as $value) {

			$location = new ZipCode;		

			$location->create([

				'zip_code' => $value['zip_code'],
				'city'	=> $value['city'],
				'county'	=> $value['county'],
				'state'	=> $value['state'],
				'district'	=> $value['district']

			]);

		}
	}

	public function update(Request $request){

		$location_id = $request->location_id;

		unset($request['location_id']);

		$data = $this->bulkFormatter($request->except('location_id'));

		foreach ($data as $value) {

			$location = ZipCode::find($location_id);		

			$location->update([

				'zip_code' => $value['zip_code'],
				'city'	=> $value['city'],
				'county'	=> $value['county'],
				'state'	=> $value['state'],
				'district'	=> $value['district'],

			]);

		}
	}

	public function editLocation(ZipCode $location){

		return view($this->clayout.'.modal.edit', compact('location'));

	}

	public function deleteLocation(ZipCode $location){

		return view($this->clayout.'.modal.delete', compact('location'));

	}

	public function destroyLocation(ZipCode $location){

		$zip = ZipCode::find($location->id);

		$zip->update([
			'is_deleted' => 1,
			'userd_id' => auth()->id()
		]);

	}

	private function bulkFormatter($req){

		reset($req);

		$first_key = key($req);
		$main = array();

		for ($i=0; $i < count($req[$first_key]) ; $i++) { 
		   array_push($main, []);
		}

		$i = 0;

		foreach ($req as $key=>$value) {

		  foreach($value as $val){

		    $main[$i++][$key] = $val;

		  }

		  $i=0;
		}

		return $main;

	}





}
