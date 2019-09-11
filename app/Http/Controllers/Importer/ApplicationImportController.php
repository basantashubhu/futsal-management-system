<?php


namespace App\Http\Controllers\Importer;


use App\Http\Controllers\Application\ApplicationController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Requests\ClientRequest;
use App\Jobs\RunImporter;
use App\Lib\File\FileUploader;
use App\Lib\Importer\ApplicationImporter;
use App\Lib\Importer\ClientImporter;
use App\Models\Application;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class ApplicationImportController extends BaseController
{

    private $clayout;

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.importer';
    }

    /**
     * Upload File Modal
     * open a dialogue
     */
    public function uploadFileModal($field)
    {
        $table = 'application';
        if ($field)
            $table = $field;
        return view($this->clayout . '.modal.addApplication', compact('table'));
    }

    /**
     * upload the file in storage
     * read the file content
     * write in the respective DB
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function importData(Request $request)
    {
        try {
            //Upload Csv and returns filenname
            $filename = $this->uploadAttachment($request->file);

            //get File full path
            $fullpath = storage_path('uploads/csv/' . $filename);

            //Get the header to create the table
            $field = $this->getCSVHead($fullpath);

            //generate temporary table
            $this->createTempTable($field);

            //load Data in DB
            $this->loadDataInTempTable($fullpath, $field);

            //import data
//            $this->loadDataInOrgTable($request->table);
            RunImporter::dispatch($request->table);

            return $this->response($request->table.' imported Successfully Please Run Command', 'php artisan queue:work', 200);
        } catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * Upload File
     *
     * @param $file
     * @return string
     */
    private function uploadAttachment($file)
    {
        $fname = FileUploader::upload($file, false, 'uploads/csv');
        return $fname;
    }

    /**
     * Load Data in temporary table
     *
     * @param $path
     * @param $field
     */
    private function loadDataInTempTable($path, $field)
    {
        $fields = implode(',', $field);
        $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE importer_temp 
                        FIELDS TERMINATED BY ',' 
                        OPTIONALLY ENCLOSED BY '\"' 
                        ESCAPED BY '\"' LINES TERMINATED 
                        BY '\\n' IGNORE 1 LINES 
                        (%s)", addslashes($path), $fields);
        return DB::connection()->getpdo()->exec($query);
    }

    /**
     * Create a Temporary table
     *
     * @param $field
     */
    private function createTempTable($field)
    {
        Schema::dropIfExists('importer_temp');
        Schema::create('importer_temp', function (Blueprint $table) use ($field) {
            foreach ($field as $f)
                $table->string($f);
            //$table->temporary();
        });
    }

    private function getCSVHead($path)
    {
        $file = fopen($path, 'r');
        $counter = 0;
        $head = '';
        if ($file != false) {
            while (!feof($file)) {
                if ($counter === 1)
                    break;

                $head = fgetcsv($file, 5000);
                ++$counter;
            }
            fclose($file);
        }
        $header = [];
        foreach ($head as $h) {
            $d = preg_replace('/[\W]/', '_', $h);
            array_push($header, $d);
        }
        return $header;
    }

    public function loadDataInOrgTable($table)
    {
        if($table=='client')
            $this->clientImport();
        elseif ($table=='application')
            $this->applicationImport();
    }


    public function clientImport()
    {
        $data = DB::table('importer_temp')->first();

        while ($data) {
            try {
                $mappData = $this->clientMapper();
                $mData = array();
                foreach ($mappData as $key => $value) {
                    $d = preg_replace('/[\W]/', '_', $key);
                    if (property_exists($data, $d))
                        $mData[$value] = $data->$d;

                    if ($d == 'email') {
                        $mData[$value] = 'fake__'.get_fake_email();
                    }
                }
                $clientImp = new ClientImporter($mData);
                $clientImp->importClient(new Request($mData));
                DB::table('importer_temp')->where('ID', $data->ID)->delete();
                $data = DB::table('importer_temp')->first();
            } catch
            (\Exception $e) {
                DB::table('importer_temp')->where('ID', $data->ID)->delete();
                throw $e;
            }
        }
        Schema::dropIfExists('importer_temp');
    }

    public function applicationImport()
    {
        $data = DB::table('importer_temp')->first();
        $flag='w';
        while ($data) {
            try {
                $mappData = $this->applicationMapper();
                $mData = array();
                foreach ($mappData as $key => $value) {
                    $d = preg_replace('/[\W]/', '_', $key);
                    if (in_array($value, $this->booleanField()))
                        $mData[$value] = $data->$d == "TRUE" ? 1 : 0;
                    elseif (property_exists($data, $d))
                        $mData[$value] = $data->$d;

                    if ($d == 'email') {
                        $mData[$value] = get_fake_email();
                    }
                }
                $applicationController=new ApplicationController();
                $applicationController->storeImports($mData,$flag);
                DB::table('importer_temp')->where('ID', $data->ID)->delete();
                $data = DB::table('importer_temp')->first();
                $flag='a';
            } catch
            (\Exception $e) {
                DB::table('importer_temp')->where('ID', $data->ID)->delete();
                throw $e;
            }
        }
    }

    public function clientMapper()
    {

        return array(
            'ID' => 'alt_id',
            'Vet Lic .' => 'vet_lic',
            'First Name' => 'fname',
            'Last Name' => 'lname',
            'Street Address' => 'add1',
            'City' => 'city',
            'Zip Code' => 'zip',
            'Cell Phone' => 'cell_phone',
            'Home Phone' => 'alt_phone',
            'Social Security (last 4)' => 'ssn',
            'Birth Date' => 'dob',
            'email' => 'personal_email'
        );
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

    public function runQueue()
    {
        Artisan::call('queue:work');
    }
}