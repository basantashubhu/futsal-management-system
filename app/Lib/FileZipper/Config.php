<?php
/**
 * Created by : Rabin Bhandari
 * Created On : 8/23/2017 1:00 PM
 *
 * THIS INTELECTUAL PROPERTY IS COPYRIGHT © 2017
 * DATATRAX PUBLISHING SYSTEMS, INC. ALL RIGHTS RESERVED
 *
 */

namespace App\Lib\FileZipper;


class Config
{
    protected $filePath;

    public function __construct( $filepath ) {
        $this->filePath = $_SERVER["DOCUMENT_ROOT"].$filepath ;
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }


    // Get Extension for ZIP is loaded or not
    public function getZipExtensionStatus()
    {
        return extension_loaded('zip');
    }
}