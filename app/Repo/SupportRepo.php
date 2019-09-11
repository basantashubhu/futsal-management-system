<?php


namespace App\Repo;

use Illuminate\Support\Facades\DB;
use App\Lib\Filter\SupportFilter\SupportFilter;
use Illuminate\Http\Request;

class SupportRepo extends BaseRepo
{
	private function joins()
	{
		return DB::table('supports')
			->join('members', 'members.user_id', 'supports.owner_id');
	}
	public function selectDataTable(Request $request)
	{
		$perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->joins()
        			->select('supports.*',
        				DB::raw('CONCAT(members.first_name," ",members.last_name) AS owner_name')
        			)
                    ->where('support_type', '!=', 'User Manual')
                    ->where('supports.is_deleted', false)->latest();
        $filter = new SupportFilter($request);
        $result = $filter->getQuery($result);
        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);


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

    public function storeUploadedFilePath($fileName, $support, $fileTitle, $document_segment = "", $document_type = "")
    {
        $fileData = array();
        $count = 0;
        $time = getSiteSettings('application_file_expiry_time');
        foreach ($fileName as $file) {
            $data = array(
                'table' => $support->getTable(),
                'table_id' => $support->id,
                'document_segment' => $document_segment != "" ? $document_segment : 'upload',
                'document_type' => $document_type != "" ? $document_type : 'file',
                'document_title' => is_array($fileTitle) ? (isset($fileTitle[$count]) ? $fileTitle[$count] : "title") : $fileTitle,
                'file_name' => $file,
                'expiry_date' => date('Y-m-d', strtotime('+' . $time)),
                'created_at' => date('Y-m-d H:i:s')
            );
            array_push($fileData, $data);
            $count++;
        }
        \App\File::insert($fileData);
    }
}