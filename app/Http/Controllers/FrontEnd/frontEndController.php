<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class frontEndController extends BaseController
{
	private $clayout ='';

	public function __construct()
	{
		parent::__construct();
		$this->clayout = $this->layout .'.frontEnd';
	}

	public function index()
	{
		return view($this->clayout.'.index');
	}
}
