<?php


namespace App\Repo;

use App\Lib\Filter\ValidationFilter\ValidationFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ValidationRepo extends BaseRepo
{
	protected function joins()
    {
        return DB::table('validations');
    }

    /*-------------------- for m datatable--------*/
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->joins()->where('is_deleted', 0)->orderBy('code', 'asc');


        $filter = new ValidationFilter($request);
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

        $result = $result->get();


        $data = [
            'meta' => [
                'page' => (int)$request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => (int)$perpage,
                'total' => (int)$totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;
    }
}