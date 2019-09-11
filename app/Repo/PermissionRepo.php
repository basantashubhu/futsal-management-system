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


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

class PermissionRepo extends BaseRepo
{
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = DB::table('permissions')
            ->join('pages', 'permissions.page_id', 'pages.id')
            ->select('page_name', 'permissions.*')->where('permissions.is_deleted', 0)
            ->when($request->input('query.generalSearch', false), function ($q, $t) {
                $q->where('permissions.name', 'like', "%$t%")
                    ->orWhere('pages.page_name', 'like', "$t");
            });

        $totalResult = $result->count();

        $result = $result->orderBy($request->sort['field'], $request->sort['sort'])
            ->limit($perpage)->offset($offset)->get();


        $data =  [
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

    public function select($orderBy = null, ...$args)
    {
        //check if variadic is empty or not
        $selectedField = '*';
        if (count($args) > 0)
            $selectedField = $args;

        $res = $this->model->select($selectedField)->where('is_deleted', 0);
        if ($this->model instanceof Permission) {
            $res->with([
                'pages' => function ($relation) {
                    $relation->select('id', 'page_name');
                }
            ]);
        }
        if ($orderBy != null)
            $res = $res->orderBy('name', 'asc');
        return $res->get();
    }
}
