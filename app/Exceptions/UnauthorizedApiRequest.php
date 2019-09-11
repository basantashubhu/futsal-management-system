<?php
/**
 * Created by PhpStorm.
 * User: kiran
 * Date: 3/6/2018
 * Time: 4:19 PM
 */

namespace App\Exceptions;


use App\Lib\BaseException\BaseResponse;

/**
 * Class UnauthorizedApiRequest
 * @package App\Exceptions
 */
class UnauthorizedApiRequest extends \Exception
{
    /**
     * @return mixed
     */
    public function render()
    {
        return BaseResponse::unAuthorized();
    }
}