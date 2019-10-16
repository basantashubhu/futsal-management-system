<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends Controller
{
    protected $layout = 'default.pages';


    /**
     * View helper function inside controller
     *
     * @param string $view
     * @param array $data
     * @return View
     */
    protected function view(string $view, array $data = [])
    {
        return view("$this->layout.$view", $data);
    }

}
