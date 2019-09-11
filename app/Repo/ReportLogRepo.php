<?php


namespace App\Repo;


use App\Lib\Filter\TextLogFilter\TextLogFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportLogRepo extends BaseRepo
{
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = DB::table('report_log')
            ->leftJoin('users', 'users.id', 'report_log.userc_id')
            ->select('report_log.*', DB::raw('COALESCE(users.name,"SYSTEM") as user_name'))
            ->where('report_type', 'text_log');

        $filter = new TextLogFilter($request);
        $result = $filter->getQuery($result);
        //countTotal Result
        $totalResult = count($result->get());
        if (isset($request->sort['field'])){
            $result = $result->orderBy($request->sort['field'], $request->sort['sort'])
            ->limit($perpage)->offset($offset)->get();
        }else{
            $result = $result->orderBy('created_at', 'desc')->limit($perpage)->offset($offset)->get();
        }

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