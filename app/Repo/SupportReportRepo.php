<?php


namespace App\Repo;


use App\Lib\Filter\SupportFilter\SupportFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportReportRepo
{
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'] == 0 ? 100000 : $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result =DB::table('supports')
                ->join('support_user','support_user.support_id','supports.id')
                ->join('users as to','to.id','support_user.assigned_to')
                ->join('users as from','from.id','support_user.assigned_from')
                ->select('supports.*','to.name as assign_to','from.name as assign_from','assigned_date',
                    DB::raw('TIMEDIFF(assigned_date,end_date) as total_time'))
                ->where('supports.is_deleted', 0);

        $filter=new SupportFilter($request);
        $result=$filter->getQuery($result);

        $result=$filter->getQueryNormal($result);

        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        $result=$result->get();


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