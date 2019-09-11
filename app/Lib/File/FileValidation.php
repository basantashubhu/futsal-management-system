<?php


namespace App\Lib\File;


class FileValidation
{
    public function check_name_length(Upload $object)
    {

        if (mb_strlen($object->file['original_filename']) > 5) {

            $object->set_error('File name is too long.');

        }
    }
}