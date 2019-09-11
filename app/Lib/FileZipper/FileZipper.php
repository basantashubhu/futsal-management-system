<?php
/**
 * Created by : Rabin Bhandari
 * Created On : 8/23/2017 1:01 PM
 *
 * THIS INTELECTUAL PROPERTY IS COPYRIGHT © 2017
 * DATATRAX PUBLISHING SYSTEMS, INC. ALL RIGHTS RESERVED
 *
 */

namespace App\Lib\FileZipper;


ini_set('max_execution_time', 5000);

use Mockery\Exception;
use ZipArchive;

class FileZipper
{
    protected $zipName;
    protected $files = array();

    /**
     * FileZipper constructor.
     * @param $files
     * @param $zipName
     */
    public function __construct($zipName, $files)
    {
        $this->zipName = $zipName;
        $this->files = $files;
    }


    public function createZip()
    {
        if (is_array($this->files)) {

            if (count($this->files)) {

                $zip = new ZipArchive();
                if ($zip->open($this->zipName, ZipArchive::CREATE) !== TRUE) {
                    exit("cannot open <$this->zipName>\n");
                }

                foreach ($this->files as $file) {
                    $download_file = file_get_contents($file);
                    #add it to the zip
                    $zip->addFromString(basename($file), $download_file);
                }

                var_dump($zip->numFiles);
                var_dump($zip->status);

                $zip->close();

                header('Content-disposition: attachment; filename="'.$this->zipName.'"');
                header('Content-type: application/zip');
                readfile($this->zipName);
                unlink($this->zipName);
            }
        }
    }
}