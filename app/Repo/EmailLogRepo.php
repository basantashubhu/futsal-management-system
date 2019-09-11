<?php


namespace App\Repo;
use Illuminate\Http\Request;
use App\Lib\Filter\Fgp\EmailLogFilter;

class EmailLogRepo extends BaseRepo
{
    /*-------------------- for m datatable--------*/
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->model->where('is_deleted', 0);
        $filter = new EmailLogFilter($request);
        if(isset($_COOKIE['email_log_adv']) || isset($_COOKIE['email_log'])){
            $advData=isset($_COOKIE['email_log_adv'])?json_decode($_COOKIE['email_log_adv']):[];
            $quickData=isset($_COOKIE['email_log'])?json_decode($_COOKIE['email_log']):[];
            $mergeData=array_merge($advData,$quickData);
            $result=$filter->getQueryCookie($result, $mergeData);
        }
        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        $result=$result->get();


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