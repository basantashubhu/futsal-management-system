<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = ['id'];

    public function fileInfo($query = null)
    {
        if (file_exists(storage_path('uploads/' . $this->file_name))) {
            $detail = [
                "mime_type" => mime_content_type(storage_path('uploads/' . $this->file_name)),
                "file" => pathinfo(storage_path('uploads/' . $this->file_name)),
            ];
            if (!is_null($query)) {
                return isset($detail[$query]) ? $detail[$query] :
                isset($detail["file"][$query]) ? $detail["file"][$query] : "false";
            }

            if ($detail['file']['extension'] == "false") {
                $f = explode('.', $this->file_name);
                $extension = "";
                foreach ($f as $ext):
                    $extension = $ext;
                endforeach;

                $detail['file']['extension'] = $extension;
            }

            return $detail;
        }
        return "false";
    }
}
