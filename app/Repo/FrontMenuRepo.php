<?php


namespace App\Repo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Filter\FrontEnd\FrontEndMenuFilter;

class FrontMenuRepo extends BaseRepo
{
	public function storeUploadedFilePath($fileName, $title, $menu_id, $seq_num, $type, $content = false, $id = false)
    {
        if($id){
            $data = array(
                'title' => $title,
                'content_type' => $type,
                'content' => $content,
                'menu_id' => $menu_id,
                'seq_num' => $seq_num,
                'file' => $fileName,
                'updated_at' => date('Y-m-d H:i:s')
            );
            \App\Models\FrontEndPageContent::find($id)->update($data);
            return true;
        }else{
            $data = array(
                'title' => $title,
                'content_type' => $type,
                'content' => $content,
                'menu_id' => $menu_id,
                'seq_num' => $seq_num,
                'file' => $fileName,
                'created_at' => date('Y-m-d H:i:s')
            );
            \App\Models\FrontEndPageContent::insert($data);
            return true;
        }
    }

    public function selectDataTable1(Request $request, $layout)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = DB::table('front_end_menus')->where('is_deleted', 0)->orderBy('menu_seq_num', 'asc');
        $result->where('co_no', $layout);

        $filter = new FrontEndMenuFilter($request);
        $result = $filter->getQuery($result);

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