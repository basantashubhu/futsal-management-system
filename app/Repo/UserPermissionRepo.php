<?php


namespace App\Repo;


use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPermissionRepo extends BaseRepo
{
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage']?: 1000;
        $offset = ($request->pagination['page']?:1 - 1) * $perpage;

        $result = DB::table('users')
            ->join('user_permission', 'user_permission.users_id', 'users.id')
            ->join('permissions', 'permissions.id', 'user_permission.permission_id')
            ->join('members as m', 'm.user_id', 'users.id')
            ->join('roles', 'roles.id', 'users.role_id')
            ->select(DB::raw('CONCAT(COALESCE(m.first_name, users.name), " ", COALESCE(m.last_name, "")) as name'), 'users.id',
                DB::raw('group_concat(permissions.name) as permission_name'), 'roles.label as role')
            ->groupBy('user_permission.users_id')
            ->when($request->input('query.generalSearch', false), function($q, $t) {
                $q->where(DB::raw('CONCAT(m.first_name, " ", m.last_name)'), 'like', "%$t%")
                    ->orWhere('permissions.name', 'like', "%$t%");
            });

        $totalResult = $result->count();

        $result = $result->orderBy($request->sort['field'], $request->sort['sort'])
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

    public function selectRolePermission($userId)
    {
        $data = $this->model->where('users_id', $userId)
            ->groupBy('users_id')->select('users_id')
            ->selectRaw('group_concat(permission_id) as permissions')
            ->first();
        return $data;
    }

    public function saveUpdate($request)
    {
        try {
            $count = DB::table('user_permission')->where('users_id', $request->user_id)->count();
            if ($count == 0):
                $data = array();
                foreach ($request->permissions as $index => $id):
                    $p = array(
                        'permission_id' => $id,
                        'users_id' => $request->user_id,
                        'created_at' => date('Y-m-d H:i:s'),
                    );
                    array_push($data, $p);
                endforeach;
                UserPermission::insert($data);
                DB::commit();
                return true;
            else:
                $error = "Rule already exit for specified group";
                throw new \Exception($error);
            endif;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function delete($id)
    {
        $res = $this->model->where('users_id', $id)->delete();
        return $this->model;
    }
}