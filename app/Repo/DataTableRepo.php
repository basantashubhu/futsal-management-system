<?php


namespace App\Repo;


use Illuminate\Http\Request;

trait DataTableRepo
{
    /*-------------------- for m datatable--------*/
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->model->where('is_deleted', 0);

        $result->when($request->input('query.generalSearch', false), function($q, $t) {
            if ($this->model->getTable() === 'pages')
                $q->where('page_name', 'like', "%$t%");
            if ($this->model->getTable() === 'roles')
                $q->where('name', 'like', "%$t%");
        });

        $totalResult = $result->count();

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

    /*-------------For Datatable------------*/
    public function dataTable(Request $request)
    {
        $offset=$request->start;
        $length=$request->length;

        $result = $this->model->where('is_deleted', 0);

        $totalResult = count($result->get());

        if (!is_null($offset))
            $result = $result->limit($length)->offset($offset);

        $result=$result->get();
        $data=[
            "draw"=>$request->draw,
            "recordsTotal"=>(int)$totalResult,
            "recordsFiltered"=>(int)$totalResult,
            "data"=>$result
        ];

        return $data;
    }
}