<?php

namespace App\Lib\File;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileUpload
{
    private $file = "";
    private $fileext = "";
    public $filename = "";
    private $validMimeTypes = array('image/jpeg','image/jpg');
    private $maxFileSize = 5; //MB
    public $process = false;
    protected $upload_file_path;
    protected $uploadpath;
    protected $uploaded = false;

    public function __construct($request, $file,$uploadpath, $mimeTypes = null)
    {
        if ($request instanceof Request) {

            if (!$request->$file || !is_file($request->$file)) {
                return $this->process;
            }

            $this->file = $request->$file;
            if (!is_null($mimeTypes)) {
                $this->validMimeTypes = $mimeTypes;
            }
            if (!is_null($uploadpath)) $this->uploadpath  = storage_path() . '/uploads/';
            else
                $this->uploadpath = $uploadpath;

            $this->validateImage($request);
        } else {
            throw  new \Exception('Error, not a instance of Request');
        }

    }

    private function validateImage($request)
    {
        $requestFileSize = ((filesize($this->file) / 1024) / 1024);
        $requestFileMIME = $this->file->getClientMimeType();
        if (is_null($requestFileMIME)) {
            return $this->process;
        }

        if (in_array($requestFileMIME, $this->validMimeTypes) && $requestFileSize <= $this->maxFileSize) {
            if (Auth::check()) {
                $this->filename = Auth::id() . "_" . uniqid() . $this->file->getClientOriginalName();
            } else {
                $this->filename = uniqid() . $this->file->getClientOriginalName();
            }
            return $this->process = true;
        }
        throw  new \Exception('Image size : ' . $requestFileSize . ' MB  is too big, Upload less than ' . $this->maxFileSize . 'MB');
    }

    public function store()
    {
        if ($this->process) {
            $this->file->move($this->uploadpath, $this->filename);
            $this->upload_file_path = $this->uploadpath . $this->filename;
            $this->uploaded = true;
            return $this;
        }
        throw  new \Exception('Image is not uploaded');
    }

    public function getUploadedFilePath()
    {
        if ($this->uploaded) {

            return $this->upload_file_path;
        }
        throw  new \Exception('Image is not uploaded');
    }

    public static function upload($request, $file, Model $table, $uploadPath = null)
    {
        if (is_null($uploadPath)) $uploadPath = storage_path() . '/uploads/';
        $file = new static($request, $file, $uploadPath);
        $file->store()->updateDatabase($table);

        return $file->getUploadedFilePath();
    }

    public function getFileInfo()
    {
        if ($this->file) {

            return $this->file;
        }
        throw new \Exception('File is not initialized');
    }

    protected function updateDatabase(Model $table)
    {
        //logic to enter in database
        $file = new \App\File;
        $file->table = $table->getTable();
        $file->table_id = $table->id;
        $file->document_segment = $this->getUploadedFilePath();
        $file->document_title = 'title';
        $file->file_name = $this->filename;
        $file->save();
        return $this;

    }


}
