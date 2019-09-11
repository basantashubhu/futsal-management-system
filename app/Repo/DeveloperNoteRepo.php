<?php


namespace App\Repo;


use App\Lib\Filter\DeveloperNoteFilter\DeveloperNoteFilter;
use App\Models\DeveloperNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeveloperNoteRepo extends BaseRepo
{
    private function joins(){
        return DB::table('developer_notes')
            ->leftJoin('users','users.id','developer_notes.user_id')
            ->join('users as creator','creator.id','developer_notes.userc_id');
    }

    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->joins()->select('developer_notes.*','users.name as reciever','creator.name as creatorname');
        /* apply filter */
        $filter = new DeveloperNoteFilter($request);
        $result = $filter->getQuery($result);
        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        $totalResult = $result->where('developer_notes.is_deleted', 0)->count();
        $result = $result->get();



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

    public function getReportData(Request $request){
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->joins()->select('developer_notes.*','users.name as reciever','creator.name as creatorname');
        /* apply filter */
        $filter = new DeveloperNoteFilter($request);
        $result = $filter->getQueryNormal($result);
        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        $result = $result->get();




        return $result;
    }
}