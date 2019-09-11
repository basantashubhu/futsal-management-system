<?php


namespace App\Repo;


use App\Lib\Filter\LookUpFilter\LookUpFilter;
use App\Lib\Filter\OrganizationFilter\OrgFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LookupRepo extends BaseRepo
{

    protected function joins()
    {
        return DB::table('lookups');
    }

    /*-------------------- for m datatable--------*/
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->joins()->where('is_deleted', 0)->orderBy('code', 'asc');


        $filter = new LookUpFilter($request);
        $result = $filter->getQuery($result);
        if($request->has('groupBy'))
            $result = $result;
        else
            $result = $result->groupBy('section');

        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);


        $result=$result->get();


        $data = [
            'meta' => [
                'page' => $request->pagination['page'],
                'pages' => ceil($totalResult / ($perpage?:$totalResult)),
                'perpage' => $perpage,
                'total' => $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;
    }

    /*-------------------- for m datatable--------*/
    public function selectSpecifiedCode(Request $request, $code)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->joins()->where('code', $code)->where('is_deleted', 0);
        $filter = new LookUpFilter($request);
        $result = $filter->getQuery($result);
        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        $result = $result->get();


        $data = [
            'meta' => [
                'page' => $request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => $perpage,
                'total' => $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;
    }
}