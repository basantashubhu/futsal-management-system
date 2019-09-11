<?php

namespace App\Http\Controllers\Email_Log;

use App\Http\Controllers\BaseController;
use App\Models\EmailLog;
use App\Repo\EmailLogRepo;
use Illuminate\Http\Request;

class EmailLogController extends BaseController
{
    private $clayout = '';
    private static $repo=null;
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.email_log.';
    }

    public function index()
    {
    	return view($this->clayout.'.index');
    }

    private static function getInstance($model)
    {
        self::$repo=new EmailLogRepo($model);
        return self::$repo;
    }

    public function store($data)
    {
        self::getInstance('EmailLog')->saveUpdate($data);
    }

    public function getAllLogs($table, $table_id)
    {
        $data = EmailLog::where('table', $table)->where('table_id', $table_id)->get();
        return $data;
    }
    public function getAll(Request $request)
    {
        $data = self::getInstance('EmailLog')->selectDataTable($request);
        return $data;
    }

    public function viewSingle($id)
    {
        $log = EmailLog::find($id);
        return view($this->clayout.'.includes.viewemail', compact('log'));
    }
}
