<?php

namespace App\Http\Controllers\AccessTokens;

use App\Http\Controllers\BaseController;
use App\Lib\BaseException\BaseResponse;
use App\User;
use Illuminate\Http\Request;
use App\Repo\PassportExtendedRepo\ClientRepository;

class ClientController extends BaseController
{

    /**
     * The client repository instance.
     *
     * @var \Laravel\Passport\ClientRepository
     */
    protected $clients;

    /**
     * The validation factory implementation.
     *
     * @var \Illuminate\Contracts\Validation\Factory
     */
    protected $validation;

    /**
     * Create a client controller instance.
     *
     * @param  \Laravel\Passport\ClientRepository $clients
     * @param  \Illuminate\Contracts\Validation\Factory $validation
     * @return void
     */
    public function __construct(ClientRepository $clients)
    {
        $this->clients = $clients;
    }

    /**
     * Store a new client.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->saveApiHit();
        if ($this->clients->validateRequest($request)):
            $userid = \App\Models\User::first()->id;
            $clients = $this->clients->createPersonalAccessClient($userid, $request->name, $request->redirect);
            return $this->clients->returnToken($clients);
        endif;
        return BaseResponse::unAuthorized();
    }
}
