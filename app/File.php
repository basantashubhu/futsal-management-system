<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $guarded = [];

    public function fileInfo($query = null)
    {
        if (extension_loaded('fileinfo')) {
                if (file_exists(storage_path('uploads/' . $this->file_name))) {
                $detail = [
                    "mime_type" => \mime_content_type(storage_path('uploads/' . $this->file_name)),
                    "file" => pathinfo(storage_path('uploads/' . $this->file_name))
                ];
                if (!is_null($query)) {
                    return isset($detail[$query]) ? $detail[$query] :
                        isset($detail["file"][$query]) ? $detail["file"][$query] : "false";
                }
                return $detail;
            }
            return "false";
        }
        else
           return response(["type"=>'error','data'=>'please enable the fileinfo extension or contact site administration'],500);
    }
}
