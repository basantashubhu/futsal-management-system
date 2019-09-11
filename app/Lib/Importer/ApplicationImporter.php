<?php


namespace App\Lib\Importer;


use App\Http\Controllers\Application\ApplicationController;
use App\Models\Application;

class ApplicationImporter implements Importable
{
    protected $datas;

    public function __construct(Array $datas)
    {
        $this->datas = $datas;
        ini_set('max_execution_time', 15000);
    }

    public function import()
    {
        $datas = $this->appimportMapper($this->datas);
        $this->storeApp($datas);
    }

    public function storeApp(Array $applications)
    {
        $flag='w';
        foreach ($applications as $app):
            if ($prevApp = $this->getApp($app['alt_id'])) {
                $app['is_secondary_app'] = $prevApp;
            }
            $in = new ApplicationController();
            if (array_key_exists('alt_id', $app) && $app['alt_id'] != '')
                $in->storeImports($app,$flag);
            $flag='a';
        endforeach;
    }

    protected function getAppids()
    {
        return Application::pluck('alt_id');

    }

    protected function getApp($id)
    {
        if ($app = Application::where('alt_id', $id)->first())
            return $app->id;
        return false;

    }


    protected function appimportMapper(Array $array)
    {
        $boolfields = $this->booleanField();
        $newarray = array();
        foreach ($array as $a) {
            $test = array();
            foreach ($this->applicationMapper() as $key => $value) {
                if (array_key_exists($key, $a)) {
                    if (in_array($value, $boolfields)) {
                        $test[$value] = $this->convertintoBoolean($a[$key]);
                    } else {
                        $test[$value] = $a[$key];
                    }
//                    $test[$value] = $a[$key];
                }
            }
            array_push($newarray, $test);
        }
        return $newarray;
    }

    public function applicationMapper()
    {
        return array(

            'ID' => 'alt_id',
            'Client' => 'client_id',
            'Application Date' => 'application_date',
            'TANF' => 'is_tanf',
            'General Assistance' => 'is_general_assistance',
            'Food Stamps' => 'is_food_stamp',
            'Medicaid' => 'is_medicaid',
            'WIC' => 'is_wic',
            'SSI - Supplemental Security Income' => 'is_ssi',
            'Soc Sec Disability' => 'is_ssd',
            'Date Eligibility Verified' => 'approved_date',
            'Agency - Verified' => 'agency_name',
            'IE Application_Rabies Vaccination' => 'is_rabbies',
            'IE Application_Rabies Date' => 'rabbies_date',
            'IE Application_Sterilization ' => 'is_sterilization',
            'IE Application_Sterilization Date' => 'sterilization_date',
            'Owner' => 'owner_id',
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


    protected function convertintoBoolean($data)
    {
        if ($data == 'TRUE')
            return 1;
        else
            return 0;
    }

    protected function utf8_encodeArray(Array $datas)
    {
        $d = array();
        foreach ($datas as $data) {
            $d[] = array_map('utf8_encode', $data);
        }
        return $d;
    }
}