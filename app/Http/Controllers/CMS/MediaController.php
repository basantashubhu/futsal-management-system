<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class MediaController extends BaseController
{
    private static $repo = null;
    private $clayout = "";

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.cms.media';
    }

    public function index()
    {
    	return view($this->clayout.'.index');
    }
}
