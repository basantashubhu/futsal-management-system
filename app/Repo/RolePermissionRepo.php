<?php


namespace App\Repo;


use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermissionRepo extends BaseRepo
{
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage']?: 1000;
        $offset = ($request->pagination['page']?:1 - 1) * $perpage;

        $result = DB::table('roles')
            ->join('role_permission', 'role_permission.role_id', 'roles.id')
            ->join('permissions', 'permissions.id', 'role_permission.permission_id')
            ->select('roles.label as name', 'roles.id',
                DB::raw('group_concat(permissions.name) as permission_name'))
//            ->groupBy('role_permission.role_id')
            ->when($request->input('query.generalSearch', false), function($q, $t) {
                $q->where('roles.name', 'like', "%$t%")
                ->orWhere('permissions.name', 'like', "%$t%");
            });

        $totalResult = $result->count(DB::raw('distinct roles.id'));

//        dd($totalResult);

        $result = $result->groupBy('role_permission.role_id')->orderBy($request->sort['field'], $request->sort['sort'])
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

    public function selectRolePermission($roleId)
    {
        $data = $this->model->where('role_id', $roleId)
            ->groupBy('role_id')->select('role_id')
            ->selectRaw('group_concat(permission_id) as permissions')
            ->first();
        return $data;
    }

    public function saveUpdate($request)
    {
        try {
            $count = DB::table('role_permission')->where('role_id', $request->role_id)->count();
            if ($count == 0):
                $data = array();
                foreach ($request->permissions as $index => $id):
                    $p = array(
                        'permission_id' => $id,
                        'role_id' => $request->role_id,
                        'created_at' => date('Y-m-d H:i:s'),
                    );
                    array_push($data, $p);
                endforeach;
                RolePermission::insert($data);
                return true;
            else:
                $error = "Rule already exit for specified group";
                throw new \Exception($error);
            endif;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function delete($id)
    {
        $res = $this->model->where('role_id', $id)->delete();
        return $this->model;
    }

}