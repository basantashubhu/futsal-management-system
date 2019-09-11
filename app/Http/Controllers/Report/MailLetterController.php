<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\BaseController;
use App\Models\MailLetter;
use App\Repo\MailLetterRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailLetterController extends BaseController
{
    /**
     * @var null
     */
    private static $repo = null;
    /**
     * @var string
     */
    private $clayout = '';

    /**
     * ClientController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.mailletter.';
    }

    /**
     * @param $model
     * @return MailLetterRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null)
            self::$repo = new MailLetterRepo($model);
        return self::$repo;
    }


    /**
     *
     */
    public function index()
    {
        return view($this->clayout . 'index');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getAll(Request $request)
    {
        $data = self::getInstance('MailLetter')->selectDataTable($request);
        return $data;
    }

    public function changeStatusView(MailLetter $letter)
    {
        return view($this->clayout . 'modal.changestatus', compact('letter'));
    }

    public function changeStatus(Request $request, MailLetter $letter)
    {
        foreach ($request->all() as $key => $val) {
            $letter->$key = $val;
        }
        $letter->useru_id = auth()->id();
        $letter->save();
        return $this->response("Mail Status Changed Successfully", "view", 200);
    }
}
