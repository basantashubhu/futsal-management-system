<?php

namespace App\Http\Controllers\Fgp\Filter;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Fgp\Site;
use App\Models\Fgp\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CascadingFilter extends Controller
{
    public function __invoke(Request $request){
    	$filters = json_decode($request->input('filter', '[]'), true);
//    	dd($request->filter);
    	$locations = DB::table('cities')
    				->leftjoin('districts','districts.id','cities.district_id')
    				->leftjoin('counties','counties.id','cities.county_id')
                    ->leftJoin('regions', 'regions.id', 'counties.region_id')

			    	->when(array_key_exists('state', $filters), function($query) use ($filters){
			    		return $query->whereIn('regions.region_name', $filters['state']);
			    	})
			    	->when(array_key_exists('county', $filters), function($query) use ($filters){
			    		return $query->whereIn('counties.county_name', $filters['county']);
			    	})
                    ->when(array_key_exists('district', $filters), function($query) use($filters) {
                        return $query->whereIn('districts.district_name', $filters['district']);
                    })->get();

		$filtered_locations = [
			'state' => [],
			'county' => [],
			'district' => [],
			'city' => [],
            'site' => collect(),
            'volunteer' => []
		];

		foreach($locations as $location){
			if(!in_array($location->region_name, $filtered_locations['state']) && $location->region_name):
				array_push($filtered_locations['state'], $location->region_name);
			endif;

			if(!in_array($location->county_name, $filtered_locations['county']) && $location->county_name):
				array_push($filtered_locations['county'], $location->county_name);
			endif;

			if(!in_array($location->district_name, $filtered_locations['district']) && $location->district_name):
				array_push($filtered_locations['district'], $location->district_name);
			endif;
		}

		$add_ids = Address::select('table_id as site_id')->where(function($address) use($filtered_locations){
            $address->where('table_name', 'sites');
            if (count($states = $filtered_locations['state'])) $address->whereIn('region', $states);
            if (count($counties = $filtered_locations['county'])) $address->whereIn('county', $counties);
            if (count($dist = $filtered_locations['district'])) $address->whereIn('district', $dist);
        })->pluck('site_id')->toArray();

        $sites = Site::select('sites.site_name', 'sites.id')->whereIn('id', $add_ids);

		$sites = $sites->get();
        $filtered_locations['site'] = $sites->pluck('site_name');

        $hasFilter = false;
        if (array_key_exists('site', $filters)) {
            $hasFilter = true;
            $sites = $sites->whereIn('site_name', $filters['site']);
        }

        $site_ids = $sites->pluck('id')->toArray();

        $filtered_locations['volunteer'] = Volunteer::select([
            DB::raw('CONCAT(first_name," ",last_name) as name'),
        ])->when($hasFilter ? $site_ids : false, function($query, $sites) {
            $query->whereRaw('id in (select volunteer_id from volunteer_sites where site_id in ('. join(',',$sites) .'))');
        })->when(!$hasFilter, function($query) {
            $query->has('assignedSites');
        })->orderBy('first_name')->pluck('name');

		return $filtered_locations;
    }
}
