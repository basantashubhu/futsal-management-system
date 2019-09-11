<?php


namespace App\Repo;
use Illuminate\Http\Request;

class ZipCodeRepo extends BaseRepo
{
    public function joins()
    {
        return DB::table('zip_codes');
    }
    /*-------------------- for m datatable--------*/
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->joins()
        ->select('zip_codes.*')->where('zip_codes.is_deleted', 0);
        $filter = new VolunteerFilter($request);
        if(isset($_COOKIE['zip_codes_advanced']) || isset($_COOKIE['zip_code'])){
            $advData=isset($_COOKIE['zip_codes_advanced'])?json_decode($_COOKIE['zip_codes_advanced']):[];
            $quickData=isset($_COOKIE['zip_code'])?json_decode($_COOKIE['zip_code']):[];
            $mergeData=array_merge($advData,$quickData);
            $result=$filter->getQueryCookie($result, $mergeData);
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