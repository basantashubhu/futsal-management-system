<?php

namespace App\Http\Controllers\Importer;

use App\Http\Controllers\BaseController;
use App\Lib\Exporter\CSVExporter;
use App\Lib\Filter\Fgp\VolunteerFilter;
use App\Repo\FGP\VolunteerRepo;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExportController extends BaseController
{
    private static $repo = "";
    public static function getVolRepo($model){
        self::$repo = new VolunteerRepo($model);
        return self::$repo;
    }

    public function volunteerExporter(){
        $data = $this->getReportData();
        $fields = array('Name', 'Email', 'Phone', 'Primary Address', 'City');
        $mapField = array('full_name', 'email', 'cell_phone', 'add1', 'city');
        $data = cleaner($mapField, $data);
        $data['table'] = 'Report of Volunteers';
        $data['request'] = '';
        if(empty($mergeData)){
            $data['request'] = ['Search' => 'All'];
        }else{
            $data['request'] = [];
            foreach($mergeData as $d):
                if($d->name=='vol_name'){
                    $data['request']['Name'] = $d->value;
                }
                if($d->name=='email'){
                    $data['request']['Email'] = $d->value;
                }
                if($d->name=='cellPhone'){
                    $data['request']['Cell Phone'] = $d->value;
                }
                if($d->name=='ssnFilter'){
                    $data['request']['SSN'] = $d->value;
                }
                if($d->name=='add1'){
                    $data['request']['Primary Address'] = $d->value;
                }
                if($d->name=='city'){
                    $data['request']['City'] = $d->value;
                }
                if($d->name=='zipCode'){
                    $data['request']['Zip Code'] = $d->value;
                }
            endforeach;
        }

        if (count($data) > 0) {

//            $export = $this->reportFactory('csv', $fields, $data);
            $export = new CSVExporter('csv', $fields, 'VolunteerReports');

            $exporter = new \App\Lib\Exporter\Exporter($export);

            $filename = $exporter->export();
            return response()->download($filename)->deleteFileAfterSend(true);
        }{
            return 'No Data Available For Current Filter';
        }
    }

    public function getReportData()
    {

        $result = self::getVolRepo('fgp\Volunteer')->joins()
            ->select(DB::raw('CONCAT(volunteers.first_name," ",COALESCE(volunteers.middle_name,"")," ",volunteers.last_name) AS full_name','volunteers.alt_id'),
                'contacts.cell_phone','contacts.email', 'address.add1', 'address.city', 'address.zip_code'
            )->where('volunteers.is_deleted', 0)->groupBy('alt_id');

        $result=$result->get();

        return $result;
    }

    public function exportCSV($filename) {
         switch ($filename) {
            case 'volunteer':
                $path = storage_path("/uploads/csv/export_volunteer.csv");
                return response()->download($path);
                break;
            case 'sites':
                 $path = storage_path("/uploads/csv/export_site.csv");   
                return response()->download($path);
                break;
            case 'address':
                 $path = storage_path("/uploads/csv/export_address.csv");   
                return response()->download($path);
                break;
            case 'holiday':
            
                 $path = storage_path("/uploads/csv/export_holiday.csv");   
                return response()->download($path);
                break;
             case 'stipend_period':
                 $path = storage_path("/uploads/csv/export_stipend_period.csv");   
                return response()->download($path);
                break;
            
            default:
                # code...
                break;
        }
    }
}
