<?php


namespace App\Repo;



use App\File;
use App\Lib\File\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ProfileRepo
 * @package App\Repo
 */
class ProfileRepo extends BaseRepo
{

    /**
     * @param $request
     * @param $file
     * @param $application
     */
    public function uploadFile($request, $file, $client)
    {
        FileUploader::upload($request, $file, $client);
    }

    public function storeUploadedFilePath($fileName, $client, $fileTitle, $document_segment = "", $document_type = "")
    {
        $data=array(
            'table'=> $client->getTable(),
            'table_id'=>$client->id,
            'document_segment' => $document_segment != "" ? $document_segment : 'upload profile picture',
            'document_type' => $document_type != "" ? $document_type : 'profile_picture',
            'document_title' => $fileTitle != "" ? $fileTitle : 'Profile Picture',
            'file_name' => $fileName,
            'created_at' => date('Y-m-d H:i:s')
        );

        $profile = $this->isPreset($client);
        if($profile):
            return $profile->update($data);
        else:
            return \App\File::insert($data);
        endif;
    }

    public function isPreset($client)
    {
        $isPreset = File::where('table', $client->getTable())->where('table_id', $client->id)->first();
        if(isset($isPreset->id)):
            return $isPreset;
        else:
            return false;
        endif;
    }

    public function getFile($segment,$type='')
    {
        $file=File::where([
            ['table',$this->model->getTable()],
            ['table_id',$this->model->id],
            ['document_segment',$segment]]);
        if($type!=null)
            $file=$file->where('document_type',$type);

        $file= $file->select('document_title','file_name')->get();
        return $file;
    }


}