<?php

namespace App\Http\Controllers\Session;

use App\Http\Controllers\BaseController;
use App\Lib\SessionHandler\SessionHandler;
use App\Models\User;
use App\Models\UserLog;
use App\Repo\UserLogsRepo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SessionController extends BaseController
{
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
        $this->clayout = $this->layout . '.pages.settings.userlogs.';
    }

    /**
     * @param $model
     * @return UserLogsRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null)
            self::$repo = new UserLogsRepo($model);
        return self::$repo;
    }

    public function index()
    {
        return view('default.pages.settings.userlogs.index');
    }

    public function ping()
    {
        $session = new SessionHandler();
        return $session->ping()->getResponse();
    }


    public function kickOut($id)
    {
        $session = new SessionHandler();
        return $session->kickOut($id)->getResponse();

    }


    public function createNewSession()
    {
        $userlog = new UserLog();
        $userlog->user_id = auth()->id();
        $userlog->login_timestamp = Carbon::now();
        $userlog->last_login_timestamp = Carbon::now();
        $userlog->save();
        session()->put('loggedin_id', $userlog->id);
    }

    public function allSessions(Request $request)
    {
        $data = self::getInstance('UserLog')->selectDataTable($request);
        return $data;
    }

    protected function getCurrentSession()
    {
        $id = session('loggedin_id');
        if ($userlog = UserLog::find($id)):
            return $userlog;
        endif;
        return false;
    }

    public function removeSession($id)
    {
        return view($this->clayout . 'modal.kickout', compact('id'));
    }

    public function lockOut($id)
    {
        return view($this->clayout . 'modal.lock', compact('id'));
    }

    public function lock(Request $request, User $user)
    {
        $user->is_locked = true;
        $user->locked_until = $request->locked_until;
        $user->locked_at = Carbon::now();
        $user->save();
        $this->kickOut($user->id);
        return $this->response($user->username . "has been locked out Successfully", "view", 200);
    }

    public function unlock($id)
    {
        return view($this->clayout . 'modal.unlock', compact('id'));
    }

    public function unlockUser(User $user)
    {
        $user->is_locked = false;
        $user->save();
        return $this->response($user->username . "has been unlocked Successfully", "view", 200);
    }
}
