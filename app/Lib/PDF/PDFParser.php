<?php
/**
 * Created by : RABIN BHANDARI.
 * Created On : 10/22/2017
 *
 * THIS INTELECTUAL PROPERTY IS COPYRIGHT © 2017
 * DATATRAX PUBLISHING SYSTEMS, INC. ALL RIGHTS RESERVED
 */

namespace App\Lib\PDF;

use Smalot\PdfParser\Parser;
use App\Lib\Image\ImageThumb;
use App\Lib\File\FileUploader;

class PDFParser
{
    private $tempUploadDir = null;
    private $pdf = "";
    private $process = false;
    private $image_name = "";
    private $image_dir = "";
    public  $fileInfo = [];


    public function __construct($data)
    {
        $this->pdf = $data;
        $this->tempUploadDir = storage_path("pdf/");

        if( $this->pdf) {
            $uploadFile = $this->tempUpload($this->pdf);
            dd($uploadFile);
            if($uploadFile) {
                $this->index($uploadFile);
            }
        }
    }

    protected function index($file)
    {
        $this->image_dir = public_path("images/base64/");

        $parser = new Parser();
        $pdf = $parser->parseFile($file);

        // Image
        $images = $pdf->getObjectsByType('XObject', 'Image');
        $total_images = count($images);
        $image = array_values($images);
        $image = isset($image[0]) ? $image[0] : false;


        if ($total_images === 1 && $image) {

            $img_detail = $image->getDetails();

            // ≈ size on KB
            $img_detail["size"] =  (int) ceil((int) $img_detail["Length"] / 1024);
            $this->fileInfo = [
                "detail" => $img_detail,
            ];
            $this->process = true;
            $this->save(base64_encode($image->getContent()), true);

        } else {
            $this->delFile($this->pdf);
        }

    }

    public function tempUpload($file)
    {
        $allowedMimeTypes = [
            'application/pdf',
            'application/octet-stream',
        ];

        if($file) {

            /**
             * Create Temp Upload Dir
            */
            if(!is_dir($this->tempUploadDir)) {
                mkdir($this->tempUploadDir);
            }

            $tempFileName = uniqid().'@'.$file->getClientOriginalName();
            $tempFileMime = $file->getClientMimeType();
            $tempFileSize = $file->getClientSize();
            if((in_array($tempFileMime, $allowedMimeTypes)) && ((($tempFileSize / 1024) / 1024) < 5)) {
                $file->move($this->tempUploadDir, $tempFileName);
                return $this->tempUploadDir.$tempFileName;
            }
        }
    }

    public function removeTempDir()
    {
        Storage::deleteDirectory($this->tempUploadDir);
    }

    // Save File into Directory
    protected function save($stream, $pdf = false)
    {
        $folder_exist = $this->cf($this->image_dir);
        if($folder_exist) {
            $data = base64_decode($stream);

            $mime_type = finfo_buffer(finfo_open(), $data, FILEINFO_MIME_TYPE);
            $extention = $this->mimeToExtention($mime_type);
            $uniq_id = uniqid();
            $this->image_name = $this->image_dir . $uniq_id.'.'.$extention;
            $this->fileInfo["extention"] =  $extention;
            $this->fileInfo["image"] =  $this->image_name;
            $this->fileInfo["pdf"] =  $this->pdf;
            $is_file_created = file_put_contents($this->image_name, $data) ? true : false;

            if ($is_file_created) {
                $resizeObj = new ImageThumb($this->image_name);
                $resizeObj->resizeImage(250, 250, 'auto');
                $resizeObj->saveImage($this->image_dir.'thumb_'.$uniq_id.".".$extention, 100);
                // If file created delete PDF
                $this->fileInfo["thumb_image"] = $this->image_dir.'thumb_'.$uniq_id.".".$extention;
            }

            // If file created delete PDF
            if($pdf) {
                $this->prepareDetail();
            } else {
                !$is_file_created ?: $this->delFile($this->pdf);
            }

        }
    }


    /**
     * @param $mimeType
     * @return bool|mixed
     */
    protected function mimeToExtention($mimeType)
    {
        $extentions = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/gif" => "gif",
            "image/bmp" => "bm"
        ];

        if(array_key_exists($mimeType, $extentions)){
            return $extentions[$mimeType];
        }
        return false;
    }



    // Create Folder If not Exist
    protected function cf($f)
    {
        return $process = is_dir($f) ?: mkdir($f, 777, true);
    }

    /**
     * @param $pdf
     */
    protected function delFile($pdf)
    {
        if(file_exists($pdf) && is_file($pdf)) {
           !unlink($pdf) ?: $this->prepareDetail();
        }
    }

    // prepare Detail
    protected function prepareDetail()
    {
        return $this->fileInfo = [
            "process" => $this->process,
            "file" => $this->fileInfo
        ];
    }

}

