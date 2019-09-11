<?php


namespace App\Repo;

use App\Lib\Filter\TemplateFilter\TemplateFilter;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailTemplateRepo extends BaseRepo
{
    public function findById($id)
    {
        if ($template = EmailTemplate::where('id', $id)->first()) {
            return $template;
        } else {
            return false;
        }
    }

    public function joins()
    {
        return DB::table('email_templates');
    }

    /*-------------------- for m datatable--------*/
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->joins()->where('is_deleted', 0);


        $filter = new TemplateFilter($request);
        $result = $filter->getQuery($result);
        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        $result = $result->get();


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