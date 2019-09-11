<?php


namespace App\Lib\Generators;

use App\Models\ConfirmationToken;
use Illuminate\Support\Facades\Crypt;

class EmailConfirmToken
{

    protected $token;

    public function GenerateToken()
    {
        $this->token = str_random(20);
        return $this;

    }

    public function savetodb($email)
    {
        if ($emailconfirm = $this->getObject($email)) {
            $emailconfirm->email = $email;
            $emailconfirm->token = Crypt::encryptString($this->token);
            $emailconfirm->save();
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    public function checkToken($email, $token)
    {
        if ($object = $this->checkObject($email)) {
            $dbtoken = Crypt::decryptString($object->token);
            if ($dbtoken == $token) {
                $object->is_active = false;
                $object->save();
                return true;
            }
        }

        return false;
    }

    public function checkTokenEmail($token)
    {
        return $this->getEmail($token);

    }

    protected function getObject($email)
    {
        if ($object = ConfirmationToken::where('email', $email)->where('is_active', true)->first()) {
            $object->is_active = true;
            return $object;
        }
        return new ConfirmationToken;
    }

    protected function checkObject($email)
    {
        if ($object = ConfirmationToken::where('email', $email)->where('is_active', true)->first()) return $object;
        return false;
    }
    public function getEmail($token)
    {
        foreach (ConfirmationToken::all() as $tokens) {
            if (Crypt::decryptString($tokens->token) == $token) {
                if ($tokens->is_active) {

                    return $tokens->email;
                }
                else{
                    return false;
                }
            }
        }
        return false;

    }
}