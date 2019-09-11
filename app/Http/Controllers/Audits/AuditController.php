<?php



namespace App\Http\Controllers\Audits;

use App\Lib\Exporter\CSVExporter;
use App\Lib\Exporter\JSONExporter;
use App\Lib\Exporter\PDFExporter;
use App\Lib\Exporter\TxtExporter;
use App\Repo\AuditRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Audit;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AuditController extends BaseController
{
    private static $repo = null;
    protected $clayout = 'default.pages.audit';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $model
     * @return AuditRepo|null
     */
    private static function getInstance($model)
    {
        self::$repo = new AuditRepo($model);
        return self::$repo;
    }


    public function index()
    {
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        return view($this->clayout . '.index', compact('tables'));
    }

    public function getAll(Request $request)
    {
        return self::getInstance('Audit')->selectDataTable($request);
    }

    public function getData($table, $table_id)
    {
        $data = Audit::where('table_name', $table)->where('table_id', $table_id)->get();
        foreach ($data as $d):
            $d->client = Client::find($d->user_id);
        endforeach;
        return $data;
    }

    public function viewSingleData($id)
    {
        $data = Audit::find($id);
        $old = json_decode($data->old_record, true);
        $new = json_decode($data->new_record, true);
        $user = $data->user;
        $changes = $this->findDiff($old, $new);
        return view('default.pages.audit.singleView', compact('new', 'old', 'changes', 'user'));
    }

    public function findDiff($old, $new)
    {
        $changes = array();
        foreach ($old as $key => $data) {
            $name = $key;
            $newdata = $new[$key];
            if ($data != $newdata) {
                $changes[$name]['old'] = $data;
                $changes[$name]['new'] = $newdata;
            }
        }
        return $changes;
    }


    public function findDiffArray($old,$new)
    {
        $old=json_decode($old,true);
        $new=json_decode($new,true);

        $oldData = array();
        $newData = array();
        foreach ($old as $key => $data) {
            $name = $key;
            $newdata = $new[$key];
            if ($data != $newdata) {
                $oldData[$key]=$data;
                $newData[$key]=$newdata;
            }
        }
        return array(
            'old_record'=>json_encode($oldData,JSON_PRETTY_PRINT),
            'new_record'=>json_encode($newData,JSON_PRETTY_PRINT)
        );
    }

    public function cleaner($mapField, $data)
    {
        $dataArr = [];
        foreach ($data as $d) {
            $singleRow = [];
            foreach ($mapField as $map) {
                if (array_key_exists($map, $d)) ;
                    $singleRow[$map] = $d->$map;
            }
            $changes=$this->findDiffArray($singleRow['old_record'],$singleRow['new_record']);
            $singleRow['old_record']=$changes['old_record'];
            $singleRow['new_record']=$changes['new_record'];
            array_push($dataArr, $singleRow);
        }
        return $dataArr;
    }

    public function exportData(Request $request,$exportType)
    {
        $data = self::getInstance('Audit')->selectDataTable($request);
        $data=$data['data'];
        $fields = array('Date', 'User', 'Table', 'ID','Old Data','New Data');
        $mapField = array('created_at', 'user', 'table_name', 'table_id', 'old_record', 'new_record');

        //clean data
        $data = $this->cleaner($mapField, $data);

        $data['table'] = 'Showing Results of Applications Table';
        $data['request'] = ['Table Name' => $request->tablename, 'Table Id' => $request->tableid, 'Date Range' => $request->dateRange, 'User' => $request->user];
        if (count($data) > 0) {
            $export = $this->reportFactory($exportType, $fields, $data);
            $exporter = new \App\Lib\Exporter\Exporter($export);
            $filename = $exporter->export();
            return response()->download($filename)->deleteFileAfterSend(true);
        }
        return 'No Data Available For Current Filter';
    }

    public function reportFactory($type, $fields, $data)
    {
        switch ($type) {
            case 'csv':
                return new CSVExporter($data, $fields, 'Audit_reports'.date('_Y_m_d_H_i_s'));
                break;
            case 'json':
                return new JSONExporter($data,'Audit_reports'.date('_Y_m_d_H_i_s'));
                break;
            case 'pdf':
                return new PDFExporter($data, $fields,'reportPdf', 'Audit_reports'.date('_Y_m_d_H_i_s'));
                break;
            default:
                throw new \Exception("Method Not Allowed " . $type);
                break;
        }
    }

    public function audit($section, $table = null)
    {
        $section = ucfirst(preg_replace('/-/', ' ', $section));
        return view($this->clayout . '.modal.auditview', compact('section', 'table'));
    }

    public function getAuditData(Request $request, $section, $table = null)
    {
        $tableArr = ['tablename' => $table ?: strtolower($section)];
        $query = is_array($request->query) ? $request->query : [];
        $request->merge(['query' => $tableArr + $query]);
        return (new AuditRepo('Audit'))->getAudits($request);
    }
}
