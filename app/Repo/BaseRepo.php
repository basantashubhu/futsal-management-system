<?php

namespace App\Repo;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BaseRepo implements Repo
{
    use DataTableRepo;

    protected $model;
    protected $action = "userc_id";
    protected $builder;

    /**
     * BaseRepo constructor.
     * the $model is either string or is object
     * if it is string it create new model instance
     * if it is object it's replicate the object
     * @param $model
     */
    public function __construct($model)
    {
        if (is_string($model)) {
            $model = '\\App\\Models\\' . $model;
            $this->model = new $model();
        } elseif (is_object($model) && ($model instanceof Model) && !$model->exists) {
            $this->model = $model;
        } elseif (is_object($model) && ($model instanceof Model)) {
            $this->model = $model;
            $this->action = 'useru_id';
        }
        $this->builder = $this->model->newQuery();
    }

    /**
     * Function can save and update the Model as per the type of private data type model
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function saveUpdate($request)
    {
        $old_record = $this->model->__toString();
        $action = $this->action;
        //check if the data is object of request
        if ($request instanceof Request) {
            $formData = $request->all();
        } elseif (is_array($request)) {
            $formData = $request;
        } else {
            throw new \Exception("undefined data");
        }

        foreach ($formData as $key => $value):
            if ($key != "formData" && $key != 'undefined') {
                $this->model->$key = $value;
            }
        endforeach;

        $this->model->$action = auth()->check() ? auth()->id() : 0;

        $user_id = 0;

        // $this->updateHeadersAlpha();

        //if action is set to useru_id that means it's update so we need to push data in audit table
        if ($this->action == "useru_id") {
            $this->audit($this->model->id, $old_record, $this->model->__toString(), auth()->check() ? auth()->id() : $user_id);
        }
        $this->model->save();
        return $this->model;
    }

    private function loadRelation($model, $relations)
    {
        foreach ($relations as $relation) {
            $model = $model->$relation;
        }
        return $model;
    }

    public function updateRelation($relation, array $data, $check = true)
    {
        $target = $check ? $this->loadRelation($this->model, explode('.', $relation)) : false;
        return $target ? save_update($target, $data) : false;
    }

    /**
     * @return mixed
     * function to select all value of database
     */
    public function selectAll()
    {
        return $this->model->all();
    }

    /**
     *
     * @return mixed
     * function to select value which is not softDeleted
     */
    public function select(...$args)
    {
        //check if variadic is empty or not
        $selectedField = '*';
        if (!empty($args)) {
            $selectedField = $args;
        }

        return $this->model->select($selectedField)->where('is_deleted', 0)->get();
    }

    /**
     * @param $id
     * @return mixed
     * function to find data by id
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->where('is_deleted', 0)->first();
    }

    /**
     * @param $id
     * @return mixed
     * function to hard delete data
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();
        return $this->model;
    }

    /**
     * @param $id
     * @return mixed
     * function to softdelete Data
     */
    public function softDelete()
    {
        $old_record = $this->model->__toString();
        $model = $this->model;
        $model->is_deleted = 1;
        $model->userd_id = auth()->id();
        $model->deleted_at = date('Y-m-d H:i:s');
        $this->audit($this->model->id, $old_record, $this->model->__toString(), auth()->check() ? auth()->id() : 0);
        $model->save();
        return true;
    }

    /**
     * @return mixed
     * function to retrive deleted data
     */
    public function retrieveDeleted()
    {
        return $this->model->where('is_deleted', 1)->get();
    }

    /**
     * @param $old_record
     * @param $new_record
     * @param $user_id
     * @return mixed
     * function to perform audit i.e to detected the change
     */
    public function audit($id, $old_record, $new_record, $user_id)
    {
        $user_id = User::find($user_id);
        if (!is_null($user_id)) {
            if (isset($user_id->id)) {
                $uid = $user_id->id;
            } else {
                $uid = 1;
            }

        } else {
            $uid = User::first()->id;
        }
        return Audit::create([
            'table_name' => $this->model->getTable(),
            'table_id' => $id,
            'old_record' => $old_record,
            'new_record' => $new_record,
            'user_id' => $uid,
        ]);
    }

    public function execute($callback, ...$args)
    {
        $callback($this->builder, request(), ...$args);
        return $this;
    }

    public function get()
    {
        return $this->builder->get();
    }

    public function paginate($count = '*')
    {
        $request = request();
        $per_page = (int) $request->input('pagination.perpage', null);
        $page = (int) $request->input('pagination.page', 1);
        $offset = $per_page ? ($page - 1) * $per_page : null;

        $totalResult = $this->countRows($this->builder, $count);

        if ($sort = $request->input('sort.sort')) {
            if ($field = $request->input('sort.field')) {
                $this->builder->orderBy($field, $sort);
            }
        }

        if ($per_page) {
            $this->builder->limit($per_page)->offset($offset);
        }

        $result = $this->builder->get();

        $data = [
            'meta' => [
                'page' => $page,
                'pages' => $per_page ? ceil($totalResult / $per_page) : 1,
                'perpage' => $per_page,
                'total' => $totalResult,
                'sort' => $sort,
                'field' => $sort ? $field : '',
            ],
            'data' => $result,
        ];
        return $data;
    }

    protected function countRows($builder, $selector = '*')
    {
        $sql_query = $builder->toSql();
        $sql_query = preg_replace('/([\n\r])([\s]{2,})/', "", $sql_query);
        $sql_query = preg_replace('/select.+from/', "select count($selector) as aggregate from", trim($sql_query));
        $sql_query = preg_replace('/(order by|having|limit|group by).+/', "", $sql_query);
        $result = DB::select($sql_query, $builder->getBindings());
        return $result[0]->aggregate;
    }

    public function parseQuery($query, Request $request)
    {
        $filters = $request->input('query');
        if (!is_array($filters)) {
            return;
        }

        foreach ($filters as $method => $value):
            if (!method_exists($this, $method = "filter_$method") || (!is_numeric($value) && !$value)) {
                continue;
            }

            call_user_func([$this, $method], $query, $value);
        endforeach;
    }
}
