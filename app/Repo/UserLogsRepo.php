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

namespace App\Repo;


use App\Lib\Filter\UserFilter\UserlogFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserLogsRepo extends BaseRepo
{
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = DB::table('user_logs')
                    ->join('users','users.id','user_logs.user_id')
                    ->select('user_logs.*','users.name','users.id as userid');

        $filter = new UserlogFilter($request);
        if(isset($_COOKIE['user_logs'])){
            $advData=isset($_COOKIE['user_logs'])?json_decode($_COOKIE['user_logs']):[];
            $result=$filter->getQueryCookie($result,$advData);
        }
        $totalResult = count($result->where('user_logs.is_active', true)->get());

        $result = $result->orderBy($request->sort['field'], $request->sort['sort'])->where('user_logs.is_active', true)
            ->limit($perpage)->offset($offset)->get();
        
        

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