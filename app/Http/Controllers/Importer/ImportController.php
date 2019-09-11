<?php

namespace App\Http\Controllers\Importer;

use App\Http\Controllers\Application\ApplicationController;
use App\Http\Controllers\Organization\OrganizationController;
use App\Lib\File\FileUploader;
use App\Lib\Importer\ApplicationImporter;
use App\Lib\Importer\ClientImporter;
use App\Lib\Importer\CsvImporter;
use App\Lib\Importer\OrganizationImporter;
use App\Lib\Importer\VetImporter;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Fgp\City;
use App\Models\Fgp\County;
use App\Models\Fgp\District;
use App\Models\Fgp\EmergencyContact;
use App\Models\Fgp\Holiday;
use App\Models\Fgp\PayPeriod;
use App\Models\Fgp\Region;
use App\Models\Fgp\Site;
use App\Models\Fgp\State;
use App\Models\Fgp\Volunteer;
use App\Models\Fgp\VolunteerDeactive;
use App\Models\Fgp\VolunteerDetail;
use App\Models\Organization;
use App\Models\User;
use App\Repo\AddressRepo;
use App\Repo\ContactRepo;
use App\Repo\OrganizationRepo;
use App\Importer\Data;
use function GuzzleHttp\Promise\exception_for;
use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class ImportController extends Controller
{
    private static $repo = null;

    private $skip_rows = 0;

    /**
     * @param $model
     * @return OrganizationRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null)
            self::$repo = new OrganizationRepo($model);
        return self::$repo;
    }

    public function index()
    {
        return view('default.pages.importer.index');
    }

    public function upload(Request $request)
    {
        $table = 'volunteers';
        if ($request->has('table')) {
            $table = $request->table;
        }
        return view('default.pages.importer.modal.add', compact('table'));
    }


    /**
     * upload csv
     * @param Request $request
     * @return array|void
     */
    public function uploadCSV(Request $request)
    {

        //Upload Csv and returns filenname
        $filename = $request->filename ?: $this->uploadAttachment($request->file);

        //gets the full paths of the uploaded file
        $fullpath = storage_path('uploads/csv/' . $filename);

        //imports data to respective table and returns imported data
        $data = $this->importFile($request, $fullpath);
        return $data;
    }

    public function mapCsvHeaders(Request $request)
    {
        $request->validate(['file' => 'required']);
        $filename = $this->uploadAttachment($request->file);
        $fullpath = storage_path("uploads/csv/$filename");
        $converter = new CsvImporter($fullpath);
        $converter->convert();
        // unlink($fullpath);
        $myTable = ucwords(preg_replace('![^a-zA-Z0-9]*!', '', $request->table));
        $func = "mapper{$myTable}Array";
        // dd($converter->header);
        return view('default.pages.importer.modal.mapHeaderModal', [
            'new_headers' => $converter->header,
            'mapping_headers' => $this->$func(),
            'filename' => $filename,
        ]);
    }

    private function checkFile($mapperData, $converter)
    {
        $headers = array_map(function ($head) {
            return strtolower($head);
        }, $converter->header);
        return array_diff_key($mapperData, array_flip($headers));
    }
    /**
     * @param Request $request
     * @param $fullpath
     * @return array
     * @throws \Exception
     */
    public function importFile(Request $request, $fullpath)
    {

        if ($request->skip_rows == null) {
            $this->skip_rows = 0;
        } else {
            $this->skip_rows = $request->skip_rows;
        }
        $converter = new CsvImporter($fullpath);
        $datas = $converter->convert()->getDatas();

        switch ($request->table) {
            case 'address':
                $mapperData = $this->mapperAddressArray();

                $check = $this->checkFile($mapperData, $converter);

                if (sizeof($check) === 0) :
                    $address = $this->utf8_encodeArray($this->importMapperGlobal($datas, $mapperData));
                    $save = $this->insertAddress($address, $request->table);
                    if ($save) :
                        return response(["message" => "Success", "status" => 200]);
                    endif;
                else :
                    return response(["message" => "You choose wrong file.", "status" => 500]);
                endif;
                break;
            case 'pay_periods':
                $mapperData = $this->mapperPayperiodArray();
                $check = $this->checkFile($mapperData, $converter);
                if (sizeof($check) === 0) :
                    $payPeriod = $this->utf8_encodeArray($this->importMapperGlobal($datas, $mapperData));
                    $payPeriod = (array) collect($payPeriod)->sortBy('start_date');

                    $save = $this->insertPayperiod($payPeriod, $request->table);

                    if ($save) :
                        return response(["message" => "Success", "status" => 200]);
                    endif;
                else :
                    return response(["message" => "You choose wrong file.", "status" => 500]);
                endif;

                break;
            case 'holiday':

                $mapperData = $this->mapperHolidayArray();
                $check = $this->checkFile($mapperData, $converter);
                if (sizeof($check) === 0) :
                    $holiday =  $this->utf8_encodeArray($this->importMapperGlobal($datas, $mapperData));
                    // $holiday = (array)collect($holiday)->sortBy('uniq_id');
                    $save = $this->insertHoliday($holiday, $request->table);

                    if ($save) :
                        return response(["message" => "Success", "status" => 200]);
                    endif;
                else :
                    return response(["message" => "You choose wrong file.", "status" => 500]);
                endif;
                break;

            case 'volunteers':

                $mapperData = $this->mapperVolunteersArray();
                $check = $this->checkFile($mapperData, $converter);

                if (sizeof($check) !== sizeof($mapperData)) :
                    $volunteer =  $this->utf8_encodeArray($this->importMapperGlobal($datas, $mapperData));
                    $save = $this->insertVolunteer($volunteer, $request->table);
                    if ($save) :
                        return response(["message" => "Success", "status" => 200]);
                    endif;
                else :
                    return response(["message" => "You choose wrong file.", "status" => 500]);
                endif;
                break;
            case 'sites':

                $mapperData = $this->mapperSitesArray();
                $check = $this->checkFile($mapperData, $converter);
                //                dd($check, $mapperData);
                if (sizeof($check) !== sizeof($mapperData)) :
                    $sites =  $this->utf8_encodeArray($this->importMapperGlobal($datas, $mapperData));
                    $save = $this->insertSiteTable($sites, $request->table);
                    if ($save) :
                        return response(["message" => "Success", "status" => 200]);
                    endif;
                else :
                    return response(["message" => "You choose wrong file.", "status" => 500]);
                endif;
                break;

            default:
                break;
        }
        return $datas;
    }

    /*=============== global mapper  =================*/
    public function importMapperGlobal(array $array, $mapper)
    {
        $request = request();
        $payperiodArray = array();
        foreach ($array as $a) {
            $formatter = array();
            foreach ($mapper as $key => $value) {
                if (array_key_exists($key, $a)) {
                    $formatter[$value] = $a[$key];
                } elseif ($here = array_search($key, $request->input('map', []))) {
                    $formatter[$value] = $a[$here];
                }
            }
            $formatter['userc_id'] = auth()->id();


            /* ========= add mannually if date to be formatted by finding key ======*/
            if (array_key_exists('created_at', $formatter))
                $formatter['created_at'] = $this->dateFormat($formatter['created_at']);

            if ((array_key_exists('start_date', $formatter) && $formatter['start_date'] != ""))
                $formatter['start_date'] = $this->dateFormat($formatter['start_date']);

            if ((array_key_exists('end_date', $formatter) && $formatter['end_date'] != ""))
                $formatter['end_date'] = $this->dateFormat($formatter['end_date']);

            if ((array_key_exists('hol_date', $formatter) && $formatter['hol_date'] != ""))
                $formatter['hol_date'] = $this->dateFormat($formatter['hol_date']);

            if ((array_key_exists('hired_date', $formatter) && $formatter['hired_date'] != ""))
                $formatter['hired_date'] = $this->dateFormat($formatter['hired_date']);

            if ((array_key_exists('dob', $formatter) && $formatter['dob'] != ""))
                $formatter['dob'] = $this->dateFormat($formatter['dob']);

            if ((array_key_exists('id_expiration_date', $formatter) && $formatter['id_expiration_date'] != ""))
                $formatter['id_expiration_date'] = $this->dateFormat($formatter['id_expiration_date']);

            if ((array_key_exists('physical_exam_date', $formatter) && $formatter['physical_exam_date'] != ""))
                $formatter['physical_exam_date'] = $this->dateFormat($formatter['physical_exam_date']);

            if ((array_key_exists('deactive_date', $formatter) && $formatter['deactive_date'] != ""))
                $formatter['deactive_date'] = $this->dateFormat($formatter['deactive_date']);
            array_push($payperiodArray, $formatter);
        }
        return $payperiodArray;
    }

    private function insertAddress(array $address, $table)
    {
        if ($table == 'address') :
            foreach ($address as $key => $add) {
                $zipCode = $add['zip_code'];
                $state_id =  $this->saveState($add['state_name']);
                $region_id =  $this->saveRegion($add['region_name'], $state_id);
                $county_id  =    $this->saveCounty($add['county_name'], $state_id, $region_id);
                $district_id  =    $this->saveDistrict($add['district_name'], $state_id, $region_id, $county_id);
                $city  =    $this->saveCity($add['city_name'], $zipCode, $state_id, $region_id, $county_id, $district_id);
            } else :
            return response(["message" => "Wrong table choosen.", "status" => 500]);
        endif;
    }

    private function saveState($state_name)
    {

        if (!$state_name == "") {
            $checkState =  State::where('state_name', $state_name)->first();
            if ($checkState == null) {
                $stateStore = State::create([
                    'state_name' => $state_name
                ]);
                return $stateStore->id;
            } else {
                return $checkState->id;
            }
        }
    }

    private function saveRegion($region_name, $state_id)
    {

        if (!$region_name == "") {
            $checkRegion =  Region::where('region_name', $region_name)->first();
            if ($checkRegion == null) {
                $regionStore = Region::create([
                    'region_name'   =>  $region_name,
                    'state_id'      =>  $state_id
                ]);
                return $regionStore->id;
            } else {
                return $checkRegion->id;
            }
        }
    }

    private function saveCounty($county_name, $state_id, $region_id)
    {


        if (!$county_name == "") {
            $checkCounty =  County::where('county_name', $county_name)->first();
            if ($checkCounty == null) {
                $countyStore = County::create([
                    'county_name'   => $county_name,
                    'state_id'      => $state_id,
                    'region_id'     => $region_id
                ]);
                return $countyStore->id;
            } else {
                return $checkCounty->id;
            }
        }
    }

    private function saveDistrict($district_name, $state_id, $region_id, $county_id)
    {

        if (!$district_name == "") {
            $checkDistrict =  District::where('district_name', $district_name)->first();
            if ($checkDistrict == null) {
                $districtStore = District::create([
                    'district_name' => $district_name,
                    'state_id' => $state_id,
                    'region_id' => $region_id,
                    'county_id' => $county_id
                ]);
                return $districtStore->id;
            } else {
                return $checkDistrict->id;
            }
        }
    }

    /*========= store city and zip ==================*/
    private function saveCity($city_name, $zip_code, $state, $region, $county, $district)
    {

        if (!$city_name == "") {
            $checkCity =  City::where('city_name', $city_name)->where('zip_code', $zip_code)->first();
            if ($checkCity == null) {
                $cityStore = City::create([
                    'city_name' => $city_name,
                    'state_id' => $state,
                    'zip_code' => $zip_code,
                    'region_id' => $region,
                    'county_id' => $county,
                    'district_id' => $district,
                ]);
                return $cityStore->id;
            } else {
                return $checkCity->id;
            }
        }
    }

    /*========== store holiday ===================*/

    private function insertPayperiod(array $payperiods, $table)
    {
        try {
            foreach ($payperiods as $payperiod) {
                foreach ($payperiod as $key => $period) {
                    if ($this->skip_rows != 0 && $key + 1 < $this->skip_rows) {
                        continue;
                    } else {
                        $checkPayperiod = PayPeriod::where('start_date', $period['start_date'])->where('end_date', $period['end_date'])->first();
                        if ($checkPayperiod) :
                            continue;
                        else :
                            \DB::table($table)->insert($period);
                        endif;
                    }
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function insertHoliday(array $holidays, $table)
    {
        try {

            foreach ($holidays as $key => $holiday) {
                if ($this->skip_rows != 0 && $key + 1 < $this->skip_rows) {
                    continue;
                } else {
                    $checkHoliday = Holiday::where('hol_date', $holiday['hol_date'])->first();

                    if ($checkHoliday) :
                        continue;
                    else :
                        \DB::table($table)->insert($holiday);
                    endif;
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }





    /*============== inserts after mapping ======*/
    protected function insertDatabase(array $datas, $table)
    {

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            \DB::table($table)->truncate();
            foreach ($datas as $data) {
                \DB::table($table)->insert($data);
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /*=============== Insert to cities Table ====*/
    private function insertSiteTable(array $sites, $table)
    {

        $address = [];
        DB::beginTransaction();
        try {
            foreach ($sites as $key => $data) {
                if ($this->skip_rows != 0 && $key + 1 < $this->skip_rows) {
                    continue;
                } else {
                    $supervisor = User::where('alt_id', $data['supervisor_alt'])->first();
                    $checkSite = Site::where('site_name', $data['site_name'])->first();

                    if ($data['city'] !== "") {
                        City::firstOrCreate(['city_name' => $data['city']]);
                    }
                    if ($data['state'] !== "") {
                        State::firstOrCreate(['state_name' => $data['state']]);
                    }
                    if ($data['county'] !== "") {
                        County::firstOrCreate(['county_name' => $data['county']]);
                    }

                    $address['city'] = $data['city'];
                    $address['state'] = $data['state'];
                    $address['county'] = $data['county'];
                    $address['add1'] = $data['add1'];
                    $address['add2'] = $data['add2'];
                    $address['zip_code'] = $data['zip_code'];

                    $site_contact['tel_phone'] = $data['tel_phone'];
                    $site_contact['alt_phone'] = $data['alt_phone'];
                    $site_contact['cell_phone'] = $data['cell_phone'];
                    $site_contact['email'] = $data['email'];
                    $site_contact['fax'] = $data['fax'];

                    if ($checkSite) :
                        if ($supervisor && !$checkSite->users()->where('users.id', $supervisor->id)->count())
                            $checkSite->users()->attach($supervisor->id);

                        $site_ad = Address::where('table_id', $checkSite->id)->where('table_name', 'sites')->first();
                        if ($site_ad) save_update($site_ad, $address);
                        $site_con = Contact::where('table_id', $checkSite->id)->where('table_name', 'sites')->first();
                        if ($site_con) save_update($site_con, $site_contact);
                        continue;
                    else :

                        $saveSite = Site::create([
                            'site_name'   => $data['site_name'],
                            'site_code'   => $data['site_code'],
                            'site_type'  => $data['site_type'],
                            'cont_per_fname'  => $data['cont_per_fname'],
                            'cont_per_mname'  => $data['cont_per_mname'],
                            'cont_per_lname'  => $data['cont_per_lname'],
                        ]);
                        if ($saveSite) :
                            if ($supervisor)
                                $saveSite->users()->attach($supervisor->id);
                            $address['table_name'] = 'sites';
                            $address['table_id'] = $saveSite->id;
                            \DB::table('address')->insert($address);

                            //save contact
                            $site_contact['table_id'] = $saveSite->id;
                            $site_contact['table_name'] = 'sites';
                            \DB::table('contacts')->insert($site_contact);
                        endif;
                    endif;
                }
            }
            //            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    /*=============== Insert to Volunteer Table ====*/
    private function insertVolunteer(array $volunteers, $table)
    {

        $address = [];
        $contact = [];
        DB::beginTransaction();
        try {

            foreach ($volunteers as $key => $data) {

                if ($this->skip_rows != 0 && $key + 1 < $this->skip_rows) {
                    continue;
                } else {

                    $data = new Data($data);

                    if (true) :

                        $supervisor =  User::where('alt_id', $data['supervisor_alt'])->first();

                        if (!$supervisor) {
                            $supervisor = User::whereHas('self', function ($member) use ($data) {
                                $member->whereRaw('concat(first_name," ", last_name) like ?', [$data['supervisor_alt']]);
                            })->first();
                        }

                        if ($data["expense_eligibility"] == "yes") {
                            $eto_eligibility = 1;
                        } else {
                            $eto_eligibility = 0;
                        }
                        // dd($data['hired_date'] && strtotime($data['hired_date']) !== false
                        //     ? date('Y-m-d', strtotime($data['hired_date'])) : '');
                        $volData = [
                            'alt_id'                => $data['alt_id'],
                            'vol_ssn'               => $data['vol_ssn'],
                            'salutation'            => $data['salutation'],
                            'title'                 => $data['title'],
                            'first_name'            => $data['first_name'],
                            'middle_name'           => $data['middle_name'],
                            'last_name'             => $data['last_name'],
                            'expense_eligibility'   => $eto_eligibility,
                            'hired_date'            => $data['hired_date'] && strtotime($data['hired_date']) !== false
                                ? date('Y-m-d', strtotime($data['hired_date'])) : '',
                            'active_date'           => $data['active_date'],
                        ];

                        // $volData = array_filter($volData);


                        $volDetail['vendor_id'] = str_pad($data['vendor_id'], 10, 0, STR_PAD_LEFT);
                        $volDetail['stipend_rate'] = $data['stipend_rate'];
                        $volDetail['eto_balance'] = $data['eto_balance'];
                        $volDetail['department'] = $data['department'];
                        $volDetail['payment_code'] = $data['payment_code'];
                        $volDetail['dob'] = $data['dob'] ? format_to_us_date($data['dob']) : '';
                        $volDetail['id_type'] = $data['id_type'];
                        $volDetail['id_expiry'] = $data['id_expiration_date'];
                        $volDetail['physical_exam_date'] = $data['physical_exam_date'];

                        $address['add1'] = $data['add1'];
                        $address['add2'] = $data['add2'];
                        $address['city'] = $data['city'];
                        $address['zip_code'] = $data['zip_code'];
                        $address['state'] = $data['state'];
                        $address['county'] = $data['county'];


                        $mainContact['tel_phone'] = $data['tel_phone'];
                        $mainContact['cell_phone'] = $data['cell_phone'];
                        $mainContact['email'] = $data['email'];

                        $emContactArr = [
                            'first_name' => $data['em_fname'],
                            'middle_name' => $data['em_mname'],
                            'last_name' => $data['em_lname'],
                            'relation' => $data['relation'],
                        ];
                        $emContactArr = array_filter($emContactArr);

                        // **** existing volunteer
                        $data['alt_id'] = str_pad($data['alt_id'], 6, 0, STR_PAD_LEFT);
                        if ($existingVol = Volunteer::where('alt_id', $data['alt_id'])->first()) {

                            $volDetail = array_filter($volDetail);

                            $saveVol = save_update($existingVol, $volData);
                            $this->saveVolDetails($volDetail, $saveVol);

                            $existingAddr = DB::table('address')
                                ->where('table_name', 'volunteers')
                                ->where('table_id', $saveVol->id)->count();
                            if ($existingAddr) {
                                DB::table('address')->where('table_name', 'volunteers')
                                    ->where('table_id', $saveVol->id)->update($address);
                            } else {
                                $address['table_name'] = 'volunteers';
                                $address['table_id'] = $saveVol->id;
                                DB::table('address')->insert($address);
                            }

                            $existingCon = DB::table('contacts')->where('table_name', 'volunteers')
                                ->where('table_id', $saveVol->id)->count();
                            if ($existingCon) {
                                $mainContact = array_filter($mainContact);
                                if(count($mainContact))
                                DB::table('contacts')->where('table_name', 'volunteers')
                                    ->where('table_id', $saveVol->id)->update($mainContact);
                            } else {
                                $mainContact['table_id'] = $saveVol->id;
                                $mainContact['table_name'] = 'volunteers';
                                DB::table('contacts')->insert($mainContact);
                            }

                            if (count($emContactArr)) {
                                $emContactArr['volunteer_id'] = $saveVol->id;
                                $emContactArr['salutation'] = $saveVol->salutation;
                                $saveEmergency = EmergencyContact::firstOrCreate($emContactArr);
                            } else $saveEmergency = false;


                            if ($saveEmergency) :
                                //save address of emergency contact
                                $emAddress = [];
                                $emAddress['add1'] = $data['em_add1'];
                                $emAddress['add2'] = $data['em_add2'];
                                $emAddress['city'] = $data['em_city'];
                                $emAddress['zip_code'] = $data['em_zip'];
                                $emAddress['state'] = $data['em_state'];

                                $emAddress = array_filter($emAddress);

                                if (DB::table('address')->where('table_name', 'emergencyContacts')->where('table_id', $saveEmergency->id)->count()) {
                                    if (count($emAddress))
                                        DB::table('address')->where('table_name', 'emergencyContacts')->where('table_id', $saveEmergency->id)->update($emAddress);
                                } elseif (count($emAddress)) {
                                    $emAddress['table_name'] = 'emergencyContacts';
                                    $emAddress['table_id'] = $saveEmergency->id;
                                    \DB::table('address')->insert($emAddress);
                                }

                                $emContact = [];

                                $emContact['tel_phone'] = $data['em_tel_phone'];
                                $emContact['cell_phone'] = $data['em_cell_phone'];
                                $emContact = array_filter($emContact);


                                if (DB::table('contacts')->where('table_name', 'emergencyContacts')->where('table_id', $saveEmergency->id)->count()) {
                                    if (count($emContact))
                                        DB::table('contacts')->where('table_name', 'emergencyContacts')->where('table_id', $saveEmergency->id)->update($emContact);
                                } elseif (count($emContact)) {
                                    $emContact['table_id'] = $saveEmergency->id;
                                    $emContact['table_name'] = 'emergencyContacts';
                                    \DB::table('contacts')->insert($emContact);
                                }

                            endif;
                            if ($supervisor && !$existingVol->supervisors()->where('users.id', $supervisor->id)->count())
                                $existingVol->supervisors()->attach($supervisor->id);

                            continue;
                        }

                        $saveVol = Volunteer::create($volData);

                        if ($saveVol) :

                            $this->saveVolDetails($volDetail, $saveVol);

                            if (trim($data['deactive_date']) && strtotime($data['deactive_date']) !== false) :
                                //volunteer deactivates
                                $volDeactivate = new VolunteerDeactive();
                                $volDeactivate->volunteer_id = $saveVol->id;
                                $volDeactivate->date = $data['deactive_date'];
                                $volDeactivate->reason = $data['deactive_reason'];
                                $volDeactivate->remarks = $data['deactive_comment'];
                                $volDeactivate->save();
                            endif;

                            //store address
                            $address['table_name'] = 'volunteers';
                            $address['table_id'] = $saveVol->id;
                            \DB::table('address')->insert($address);



                            //store contact
                            $mainContact['table_id'] = $saveVol->id;
                            $mainContact['table_name'] = 'volunteers';
                            \DB::table('contacts')->insert($mainContact);



                            $saveEmergency = count($emContactArr) ? EmergencyContact::create($emContactArr) : false;

                            if ($saveEmergency) :
                                //save address of emergency contact
                                $emAddress = [];
                                $emAddress['add1'] = $data['em_add1'];
                                $emAddress['add2'] = $data['em_add2'];
                                $emAddress['city'] = $data['em_city'];
                                $emAddress['zip_code'] = $data['em_zip'];
                                $emAddress['state'] = $data['em_state'];

                                $emAddress = array_filter($emAddress, function ($val) {
                                    return strlen(trim($val));
                                });

                                if (count($emAddress)) {
                                    $emAddress['table_name'] = 'emergencyContacts';
                                    $emAddress['table_id'] = $saveEmergency->id;
                                    \DB::table('address')->insert($emAddress);
                                }

                                $emContact = [];
                                $emContact['tel_phone'] = $data['em_tel_phone'];
                                $emContact['cell_phone'] = $data['em_cell_phone'];
                                $emContact = array_filter($emContact, function ($val) {
                                    return strlen(trim($val)) > 0;
                                });

                                if (count($emContact)) {
                                    $emContact['table_id'] = $saveEmergency->id;
                                    $emContact['table_name'] = 'emergencyContacts';
                                    \DB::table('contacts')->insert($emContact);
                                }

                            endif;

                            if ($supervisor)
                                $saveVol->supervisors()->attach($supervisor->id);
                        endif;
                    endif;
                }
            }
            //            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    private function saveAddress($table_name, $table_id)
    { }

    /*===============  ends ==================*/
    private function dateFormat($rawDate)
    {
        return date('Y-m-d', strtotime($rawDate));
    }



    public function importSingle($filepath, $count = 0)
    {
        $converter = new CsvImporter($filepath);
        $data = $converter->getSingleIndex($count);

        return $total = $converter->total() - 1;
    }

    public function createObject($table, $data)
    {
        switch ($table) {
            case 'organization':
                return new OrganizationImporter($data);
                break;
            case 'vet':
                return new VetImporter($data);
                break;
            case 'application':
                return new  ApplicationImporter($data);
                break;
            case 'client':
                return new ClientImporter($data);
                break;
            default:
                return new ClientImporter($data);
        }
    }

    protected function storeRate(array $rate)
    {
        \DB::table('rate_plan')->insert($rate);
    }

    protected function storeBreed(array $datas, $table = 'pet_breeds')
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table($table)->truncate();
        foreach ($datas as $data) {
            \DB::table($table)->insert($data);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }



    protected function utf8_encodeArray(array $datas)
    {
        $d = array();
        foreach ($datas as $data) {
            $d[] = array_map('utf8_encode', $data);
        }
        return $d;
    }

    public function uploadAttachment($file)
    {
        $fname = FileUploader::upload($file, false, 'uploads/csv');
        return $fname;
    }

    protected function updateProviders($organizations)
    {
        DB::beginTransaction();
        try {

            $contactField = ['phone', 'cell_phone', 'alt_phone', 'fax', 'personal_email', 'company_email', 'url'];
            $addressField = ['add1', 'add2', 'zip', 'city', 'state', 'county'];
            //seprate data of client contact and address
            $data = $this->getOrganizationField($organizations, $contactField, $addressField);
            //getData
            $organization = self::getInstance('Organization')->saveUpdate($data['data']);

            //add contact
            (new ContactRepo())->storeContact($data['contact'], $organization);

            //addAddress
            (new AddressRepo())->storeAddress($data['address'], $organization);

            DB::commit();

            return $this->response("Organization Added SuccessFully", "view", 200);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response("Can't Add Organization", 'view', 422);
        }
    }


    /**
     * @param $data
     * @param $contactField
     * @param $addressField
     * @return array
     */
    public function getOrganizationField($data, $contactField, $addressField)
    {

        $contact = array();
        $address = array();

        foreach ($contactField as $f) {
            if (isset($data[$f]) && !is_null($data[$f])) :
                $contact[$f] = $data[$f];
            endif;
            unset($data[$f]);
        }

        foreach ($addressField as $f) {
            if (isset($data[$f]) && !is_null($data[$f])) :
                $address[$f] = $data[$f];
            endif;
            unset($data[$f]);
        }
        return ['data' => $data, 'contact' => $contact, 'address' => $address];
    }

    protected function makeRequestObject(array $array)
    {
        $request = new Request($array);
        $request->setMethod('POST');
        return $request;
    }

    public function storeOrg(array $organizations)
    {
        foreach ($organizations as $org) :
            $org['external_id'] = 0;
            $requestobj = $this->makeRequestObject($org);
            $in = new OrganizationController();
            if ($org['is_approved'] == 'Yes')
                $approved = true;
            else
                $approved = false;

            $val = $in->insertData($requestobj, true, $approved);
        endforeach;
    }

    public function storApp(array $appplications)
    {
        foreach ($appplications as $app) :
            $in = new ApplicationController();
            $val = $in->storeImports($app);
        endforeach;
    }



    public function importMapper(array $array)
    {
        $already = Organization::pluck('lic_no')->toArray();
        $newarray = array();
        foreach ($array as $a) {
            if (!in_array($a['Establishment #'], $already)) :
                $formatter = array();
                foreach ($this->orgMapper() as $key => $value) {
                    if (array_key_exists($key, $a)) {
                        array_push($already, $a[$key]);
                        $formatter[$value] = $a[$key];
                    }
                }

                $formatter['personal_email'] = 'kkc' . random_string() . '@zeuslogic.com';
                array_push($newarray, $formatter);
            endif;
        }
        return $newarray;
    }

    public function breedMapper(array $array)
    {
        $newarray = array();
        foreach ($array as $a) {
            $formatter = array();
            foreach ($this->breedMapperArray() as $key => $value) {
                if (array_key_exists($key, $a)) {
                    $formatter[$value] = $a[$key];
                }
            }
            $formatter['userc_id'] = auth()->id();
            array_push($newarray, $formatter);
        }
        return $newarray;
    }



    private function orgMapper()
    {
        return array(
            'Establishment #' => 'lic_no',
            'Providers_Vet Practice' => 'cname',
            'Address' => 'add1',
            'City' => 'city',
            'State' => 'state',
            'Zip' => 'zip',
            'Phone' => 'phone',
            'Vet First Name' => 'fname',
            'Vet Last Name' => 'lname',
            'Directory Listing' => 'is_dir_listing',
            'Approved Provider' => 'is_approved',
            'Vet Lic #' => 'vet_lic'
        );
    }

    public function appimportMapper(array $array)
    {
        $boolfields = $this->booleanField();
        $newarray = array();
        foreach ($array as $a) {
            $formatter = array();
            foreach ($this->applicationMapper() as $key => $value) {
                if (array_key_exists($key, $a)) {
                    if (in_array($value, $boolfields)) {
                        $formatter[$value] = $this->convertintoBoolean($a[$key]);
                    } else {
                        $formatter[$value] = $a[$key];
                    }
                }
            }
            array_push($newarray, $formatter);
        }
        return $newarray;
    }

    private function applicationMapper()
    {
        return array(
            'IE Application_ID' => 'alt_id',
            'Application Date' => 'application_date',
            'TANF' => 'is_tanf',
            'General Assistance' => 'is_general_assistance',
            'Food Stamps' => 'is_food_stamp',
            'Medicaid' => 'is_medicaid',
            'WIC' => 'is_wic',
            'SSI - Supplemental Security Income' => 'is_ssi',
            'Soc Sec Disability' => 'is_ssd',
            'Date Eligibility Verified' => 'approved_date',
            'Agency - Verified' => 'provider_id',
            'First Name' => 'fname',
            'Last Name' => 'lname',
            'Street Address' => 'add1',
            'City' => 'city',
            'Zip Code' => 'zip',
            'Home Phone' => 'phone',
            'Cell Phone' => 'cell_phone',
            'Alternative Phone' => 'alt_phone',
            'Social Security (last 4)' => 'ssn',
            'Birth Date' => 'dob',
            'Pet Name' => 'pet_name',
            'Type of Pet' => 'type_of_Pet',
            'Age Type' => 'age_type',
            'Age of Pet' => 'age_of_pet',
            'Weight' => 'weight',
            'Where Animal Obtained' => 'where_obtained',
            'Copay Rcvd' => 'is_copay_paid',
            'Copay Amt Rcvd' => 'copay_amt',
            'Pet Registration_SN Provider' => 'provider_name',
            'Pet Registration_Rabies Vaccination' => 'is_rabbies_vaccination',
            'Pet Registration_Rabies Date' => 'is_rabbies_date',
            'Pet Registration_Sterilization Date' => 'is_sterilization_date',
            'Pet Registration_Veterinarian' => 'vet',
            'Pet Registration_Invoice Date' => 'invoice_date',
            'Pet Registration_Invoice #' => 'invoice_number',
            'Pet Registration_Comments' => 'comments',
            'Pet Registration_Amt Funded' => 'funded_amount',
            'Contingent Max' => 'contigent_max',
            'Contingent Shelter' => 'contigent_shelter',
            'Contingent' => 'contigent',
            'Pet Registration_Compilications' => 'is_complicated',
            'Pet Registration_Complication Details' => 'complication_details',
            'Breed/Color/Unique Traits' => 'color'
        );
    }

    private function booleanField()
    {
        return array(
            'is_tanf', 'is_medicaid', 'is_general_assistance', 'is_food_stamp', 'is_wic', 'is_ssi', 'is_ssd'
        );
    }

    private function breedMapperArray()
    {
        return [
            'type' => 'type',
            'Breed' => 'breed',
            'Country' => 'country',
            'Origin' => 'origin',
            'Image' => 'image',
        ];
    }

    private function mapperAddressArray()
    {
        return [
            'city' => 'city_name',
            'zip' => 'zip_code',
            'state' => 'state_name',
            'county' => 'county_name',
            'region' => 'region_name',
            'district' => 'district_name',
        ];
    }

    private function mapperPayperiodArray()
    {
        return [
            'pay_code' => 'pay_code',
            'pay_period' => 'period_no',
            'budget_year' => 'fiscal_year',
            'start_date' => 'start_date',
            'end_date' => 'end_date',
        ];
    }

    private function mapperHolidayArray()
    {
        return [



            'holiday_type'          => 'cal_type',
            'code'              => 'code',
            'county'            => 'county',
            'description'       => 'name',
            'paid_flag'         => 'paid_flag',
            'eto_eligibility'          => 'eto_eligibility',
            'holiday_date'          => 'hol_date',
            'state'           => 'state_r',
        ];
    }

    private function mapperSitesArray()
    {
        return [
            'site_code'    => 'site_code',
            'site_name'    => 'site_name',
            'site_type'    => 'site_type',
            'add1'  => 'add1',
            'add2'  => 'add2',
            'city'    => 'city',
            'zip'   => 'zip_code',
            'state'   => 'state',
            'county'  => 'county',


            'phone'  => 'tel_phone',
            'alt_phone'  => 'alt_phone',
            'fax'  => 'fax',
            'ctc_fname'  => 'cont_per_fname',
            'ctc_mname'  => 'cont_per_mname',
            'ctc_lname'  => 'cont_per_lname',
            'ctc_cell'  => 'cell_phone',
            'ctc_email'  => 'email',
            'supervisor_id' => 'supervisor_alt'
        ];
    }

    private function mapperCityArray()
    {
        return [
            'city'              => 'city_name',
            'zip_code'          => 'zip_code',
        ];
    }

    private function mapperVolunteersArray()
    {
        return [
            'alt_id'        =>    'alt_id',
            'ssn'             =>    'vol_ssn',
            'salutation'    =>    'salutation',

            'volunteer_title' =>    'title',
            'department_code'       =>      'department',
            'payment_code'          =>      'payment_code',


            'fname'    =>    'first_name',
            'mname'   =>    'middle_name',
            'lname'     =>    'last_name',

            'eto_eligibility'       =>      'expense_eligibility',
            'eto_balance'           =>      'eto_balance',
            'hired_date'             =>      'hired_date',

            'dob'             =>    'dob',


            'add1'            =>    'add1',
            'add2'            =>    'add2',
            'city'            =>    'city',
            'zip'             =>    'zip_code',
            'state'           =>    'state',
            'county'          =>    'county',


            'volunteer_tel_no'    =>    'tel_phone',
            'volunteer_cell'      =>    'cell_phone',
            'volunteer_email'     =>    'email',


            'emergency_ctc_fname'       =>    'em_fname',
            'emergency_ctc_mname'       =>    'em_mname',
            'emergency_ctc_lname'       =>    'em_lname',
            'emergency_ctc_relation'    =>    'relation',

            'emergency_ctc_phone'       =>    'em_tel_phone',
            'emergency_ctc_cell'        =>    'em_cell_phone',

            'emergency_ctc_add1'        =>    'em_add1',
            'emergency_ctc_add2'        =>    'em_add2',
            'emergency_ctc_city'        =>    'em_city',
            'emergency_ctc_zip'         =>    'em_zip',
            'emergency_ctc_state'       =>    'em_state',



            'supervisor_id'             =>      'supervisor_alt',
            'vendor_id'             =>      'vendor_id',
            'id_type'               =>      'id_type',
            'id_expiration_date'    =>      'id_expiration_date',
            'physical_exam_date'    =>      'physical_exam_date',
            'stipend_rate'          =>      'stipend_rate',

            /*------ volunteer_deactivates table -----*/

            'deactive_date'         =>      'deactive_date',
            'deactive_reason'       =>      'deactive_reason',
            'deactive_comment'      =>      'deactive_comment',

        ];
    }

    private function mapperCountyArray()
    {
        return [
            'county_name'           =>  'county_name',
            'description'           =>  'description',
        ];
    }

    public function rateMapper(array $array)
    {
        $newarray = array();
        foreach ($array as $a) {
            $formatter = array();
            foreach ($this->rateMapperArray() as $key => $value) {
                if (array_key_exists($key, $a)) {
                    if ($key == 'start_date' || $key == 'end_date') {
                        $formatter[$value] = date('Y-m-d', strtotime($a[$key]));
                    } else
                        $formatter[$value] = $a[$key];
                }
            }
            $formatter['userc_id'] = auth()->id();
            array_push($newarray, $formatter);
        }
        return $newarray;
    }

    private function rateMapperArray()
    {
        return [
            'Plan Name' => 'plan_name',
            'Description' => 'description',
            'Includes' => 'includes',
            'Terms' => 'terms',
            'Notes' => 'notes',
            'start_date' => 'start_date',
            'end_date' => 'end_date',
        ];
    }

    protected function convertintoBoolean($data)
    {
        if ($data == 'Yes')
            return 1;
        else
            return 0;
    }

    public function downloadSample($filename)
    {
        return response()->download(storage_path('uploads/samples/' . $filename));
    }

    public function getMonitor($field)
    {
        return view('default.pages.importer.monitor', compact('field'));
    }

    private function saveVolDetails(array $volDetail, $saveVol)
    {
        $finalDetail = [];
        foreach ($volDetail as $key => $detail) {
            if (!trim($detail)) continue;
            $lable = explode('_', $key);
            $fullLabel = implode(" ", $lable);
            if ($key == "id_expiry" || $key == "physical_exam_date") {
                $data_type = "date";
            } else {
                $data_type = "string";
            }
            array_push($finalDetail, [
                "label" => ucfirst($fullLabel),
                "code" => $key,
                "value" => $detail,
                "data_type" => $data_type,
                "volunteer_id" => $saveVol->id
            ]);
        }

        foreach ($finalDetail as $detail) {
            if (DB::table('volunteer_details')->where('code', $detail['code'])->where('volunteer_id', $saveVol->id)->count()) {
                DB::table('volunteer_details')->where('code', $detail['code'])->where('volunteer_id', $saveVol->id)->update($detail);
                // dump($detail);
            } else {
                DB::table('volunteer_details')->insert($detail);
            }
        }
    }
}
