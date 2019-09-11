<?php

namespace App\Lib\BaseException;


class BaseResponse
{
    /**
     * @var string
     */
    protected $type, $message, $options = array(), $status_code = 200;

    /**
     * BaseException constructor.
     * @param $message
     * @param string $type
     * @param array $options
     */
    public function __construct($message = '', $type = "error", $options = array(), $status_code = 200)
    {
        $this->type = $type;
        $this->message = $message;
        $this->options = $options;
        $this->status_code = $status_code;
    }

    /**
     * Format Exception  message and response it
     *
     * @return array
     * */
    public function send()
    {
        return array(

            'code' => $this->status_code,
            'status' => strtoupper($this->type),
            'message' => $this->message,
            'data' => $this->options
        );
    }

    /**
     * @return mixed
     */
    public static function unAuthorized()
    {
        $response = new static('Forbidden Access, Authorization Header not set', 'error', [], 401);
        return $response->send();
    }

    public static function templateNotFound($message, $code = 404)
    {
        $response = new static($message, 'error', [], $code);
        return $response->send();
    }

    public static function validationError($error, $code = 100)
    {
        $response = new static($error, 'error', [], $code);
        return $response->send();
    }

    public static function response($message, $status, $data = array())
    {
        $response = new static($message, $status, $data);
        return $response->send();
    }
}
