<?php


namespace App\Lib\Importer;


use App\Http\Controllers\Organization\OrganizationController;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationImporter implements Importable
{
    public $datas;

    public function __construct(Array $datas)
    {
        $this->datas = $datas;
    }


    protected function makeRequestObject(Array $array)
    {
        $request = new Request($array);
        $request->setMethod('POST');
        return $request;
    }

    public function import()
    {
        $array = $this->datas;
        $already = Organization::pluck('lic_no')->toArray();
        $organizations = array();
        foreach ($array as $a) {
            if (!in_array($a['Establishment #'], $already)):
                $org = array();
                foreach ($this->Mapper() as $key => $value) {
                    if (array_key_exists($key, $a)) {
                        array_push($already, $a[$key]);
                        $org[$value] = $a[$key];
                    }
                }
                $org['personal_email'] = 'fake__' . random_string() . '@zeuslogic.com';
                $org['is_imported'] = true;
                array_push($organizations, $org);
            endif;
        }
        $this->store($organizations);
        return $organizations;
    }

    public function store(Array $organizations)
    {
        foreach ($organizations as $org):
            $org['external_id'] = 0;
            $requestobj = $this->makeRequestObject($org);
            $in = new OrganizationController();
            if ($org['is_approved'] == 'TRUE' || $this->checkExist($org['phone'],$org['cname']))
                $approved = true;
            else
                $approved = false;

            $val = $in->insertData($requestobj, true, $approved);
        endforeach;
    }

    public function checkExist($phone,$cname)
    {
        $phone=preg_replace('/[^A-Za-z0-9]/','',$phone);
        $ct= DB::table('providers_list_report')->where('phone',$phone)->orWhere('provider','like',$cname.'%')->count();
        return $ct>0;
    }

    private function Mapper()
    {
        return array(
            'Establishment #' => 'lic_no',
            'Vet Practice' => 'cname',
            'Address' => 'add1',
            'City' => 'city',
            'State' => 'state',
            'Zip' => 'zip',
            'Phone' => 'phone',
            'Comments' => 'comments',
            'Directory Listing' => 'is_dir_listing',
            'Approved Provider' => 'is_approved',
        );

    }


}