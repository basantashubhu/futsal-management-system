<?php


namespace App\Exceptions;


use App\Lib\BaseException\BaseResponse;

class ValidationError extends \Exception
{
    /**
     * @return mixed
     */
    public function render()
    {
        return BaseResponse::validationError($this->getMessage(), $this->getCode());
    }

}