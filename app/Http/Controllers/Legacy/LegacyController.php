<?php


namespace App\Http\Controllers\Legacy;


use App\Http\Controllers\BaseController;

class LegacyController extends BaseController
{

    private $clayout;
    public function __construct()
    {
        parent::__construct();
        $this->clayout=$this->layout.'.pages.legacy.';
    }

    public function ieLegacy()
    {
        return view($this->clayout.'ie.index');
    }

    public function providerLegacy()
    {
        return view($this->clayout.'provider.index');
    }
}