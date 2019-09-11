<?php


namespace App\Repo;


use Illuminate\Http\Request;

class MailLetterRepo extends BaseRepo
{
    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->model->where('is_deleted', 0);

        $totalResult = count($result->get());

        $results = $result->orderBy($request->sort['field'], $request->sort['sort'])
            ->limit($perpage)->offset($offset)->get();
        foreach ($results as $result) {
            $result->files();
        }

        $data = [
            'meta' => [
                'page' => $request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => $perpage,
                'total' => $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $results
        ];
        return $data;
    }
}