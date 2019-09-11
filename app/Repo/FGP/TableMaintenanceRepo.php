<?php
/**
 * @author Suman Thaapa -- Lead 
 * @author Prabhat gurung 
 * @author Basanta Tajpuriya 
 * @author Rakesh Shrestha 
 * @author Manish Buddhacharya 
 * @author Lekh Raj Rai 
 * @author Ascol Parajuli
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */ 

namespace App\Repo\FGP;

use App\Lib\Filter\Fgp\MaintenanceFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repo\BaseRepo;

class TableMaintenanceRepo extends BaseRepo
{
    protected function joins()
    {
        return DB::table('table_maintenances');
    }
    /*-------------------- for m datatable--------*/
    public function selectDataTable(Request $request)
    {
        $perpage = $request->input('pagination.perpage', 1000);
        $offset = ($request->input('pagination.page', 1) - 1) * $perpage;

        $result = $this->joins()->where('is_deleted', 0);
        $filter = new MaintenanceFilter($request);
        if(isset($_COOKIE['table_main'])){
            $advData=isset($_COOKIE['table_main'])?json_decode($_COOKIE['table_main']):[];
            $result=$filter->getQueryCookie($result,$advData);
        }

        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        // $totalResult = count($result->get());

        $result=$result->get();

        $data = [
            'meta' => [
                'page' => (int)$request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => (int)$perpage,
                'total' => $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;
    }
}