<?php


namespace App\Exceptions;


use App\Lib\BaseException\BaseResponse;

class TemplateNotFound extends \Exception
{
    public function render()
    {
        return BaseResponse::templateNotFound($this->getMessage(), $this->getCode());
    }
}