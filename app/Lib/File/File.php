<?php


namespace App\Lib\File;


class File
{
    protected $file, $location;

    /**
     * Max. file size
     *
     * @var int
     */
    protected $max_file_size;

    /**
     * upload File Path
     *
     * @var int
     */
    protected $upload_file_path;


    /**
     * Filename (new)
     *
     * @var string
     */
    protected $filename;


    public function __construct($file, $location = '/upload/')
    {

        $this->file = $file;
        $this->location = public_path() . $location;
    }

    public function uploadFile()
    {
        $filename = rand() . $this->file->getClientOriginalName();
        dd($this->file);
        $file = $this->file->move($this->location, $filename);
        $this->upload_file_path = $this->location . $filename;
        return $this;

    }


    public function getUploadFile()
    {
        dd($this->file);
//        dd(filesize($this->upload_file_path));
        if (filesize($this->upload_file_path) > 5) {
            dd('error');

        } else {
            dd('done');
        }
    }

    public static function upload($file, $location = '/upload/')
    {
        $file = new static($file, $location);
        return $file->uploadFile()->getUploadFile();

    }


}