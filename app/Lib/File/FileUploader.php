<?php


namespace App\Lib\File;


use App\Lib\Image\ImageThumb;

define('DS', DIRECTORY_SEPARATOR);

ini_set('upload_max_filesize', '10M');
class FileUploader
{
    public function __construct()
    {
        ini_set('upload_max_filesize', '10M');
    }

    public static function upload($f, $isImg = false, $loc = 'uploads')
    {
        $fileType = $f->getClientMimeType();
        if ($isImg):
            $isValid = self::checkImageMimeType($fileType);
            if (!$isValid):
                $error = "Invalid File Format, Required images";
                throw new \Exception($error);
            endif;
        else:
            $isValid = self::validateFileType($fileType);
            if (!$isValid):
                $error = "Invalid File Format, Required images or pdf";
                throw new \Exception($error);
            endif;
        endif;

        if (!$isValid):
            $error = "Invalid File Format, Required images or pdf";
            throw new \Exception($error);
        endif;
        $fileExtension = $f->getClientOriginalExtension();
        $fileName = md5(time() . rand());
        $fileName = $fileName . '.' . $fileExtension;

        if (!file_exists(storage_path($loc))) {
            mkdir(storage_path($loc), 0777, true);
        }

        $f->move(storage_path($loc . DS), $fileName);

        return $fileName;
    }

    public static function validateFileType($type)
    {
        $fileType = array('image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif',
            'image/gif',
            'application/pdf',
            'application/octet-stream',
            'image/bmp',
            'image/webp',
            'image/svg',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain');
        return in_array($type, $fileType);

    }

    public static function checkImageMimeType($type)
    {
        $fileType = array('image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif',
            'image/svg',
        );
        return in_array($type, $fileType);
    }
}