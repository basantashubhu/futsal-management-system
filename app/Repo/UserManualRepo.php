<?php


namespace App\Repo;

use Illuminate\Support\Facades\DB;
use App\Lib\Filter\SupportFilter\SupportFilter;
use Illuminate\Http\Request;
use App\File;

class UserManualRepo extends BaseRepo
{
	public function storeUploadedFilePath($fileName, $manual, $fileTitle, $document_segment = "", $document_type = "")
    {
        $fileData = array();
        $count = 0;
        $time = getSiteSettings('application_file_expiry_time');
        foreach ($fileName as $file) {

            $data = array(
                'table' => $manual->getTable(),
                'table_id' => $manual->id,
                'document_segment' => $document_segment != "" ? $document_segment : 'User Manual',
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