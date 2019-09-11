<?php


namespace App\Lib\SessionHandler;

use App\Models\SiteSettings;
use App\Models\User;
use App\Models\UserLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SessionHandler
{
    /**
     * @var
     */
    protected $sid;
    /**
     * @var bool
     */
    protected $userlog = false;
    /**
     * @var array
     */
    protected $response = array();
    /**
     * @var int
     */
    protected $pingtime = 30;

    /**
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * SessionHandler constructor.
     * @param $sid
     */
    public function __construct()
    {
        $this->getCurrentSession();
        $this->pingtime = (float) tap(SiteSettings::firstOrNew(array(
            'code' => 'ping_time'
        )), function($setting) {
            if ($setting->exists) return;
            $setting->value = 30;
            $setting->description = 'Max time to wait for user ping request or inactivity. [Default is 30 minutes]';
            $setting->save();
        })->value;
    }

    /**
     * @return bool
     */
    protected function getCurrentSession()
    {
        $id = session('loggedin_id');
        if ($userlog = UserLog::find($id)):
            $this->userlog = $userlog;
            return true;
        endif;
        $this->userlog = false;
        return false;
    }

    /**
     * Pings the User
     * @return $this
     */
    public function ping()
    {
        $this->checkInactive();

        //checks for valid session
        if ($this->userlog) {
            //checks if user is kickout
            if (!$this->userlog->is_kickout) {
                //checks for validity

                if ($this->checkValidity()) {
                    $this->userlog->last_call_timestamp = Carbon::now();
                    $this->userlog->save();
                    //pings succesfully
                    $this->successfulResponse();

                } else {
                    //inactive so Removes Login
                    $this->removeLogin('Your session is inactive');
// dd('asdf');
                    $this->sessionInactiveResponse();
                }

            } else {
                //Sends Kickout Response
                $this->kickedOutResponse();
            }

        } else {
            //sends inactive session response
            $this->sessionInactiveResponse();
        }
        return $this;
    }

    public function checkInactive()
    {
        $userlog = UserLog::where('is_active', 1)->where('user_id', auth()->id())->limit(10)->get();
        foreach ($userlog as $log) {
            $date1 = date('Y-m-d H:i:s', session('last_call'));
            $now = date('Y-m-d H:i:s');
            $timeDiff = date_difference($now, $date1);
            if ($timeDiff > $this->pingtime) {
                $log->is_active = 0;
                $log->save();
            }
        }
    }
    /**
     * checks if user is active or note
     * @return bool
     */
    public function checkValidity()
    {
        if (!$this->userlog->is_active) {
            $this->removeLogin('Your session is inactive');
            return false;
        }
        return true;
    }

    //checks session according to credentials

    /**
     * @param $credentials
     */
    public function checkSessions($credentials)
    {
        $this->checkUserSession($credentials);
    }

    //checks users sessions

    /**
     * @param $credentials
     */
    public function checkUserSession($credentials)
    {
        if ($user = User::where($credentials)->first()):
            if ($session = UserLog::where('user_id', $user->id)->get()) {
                $this->removeOtherSession($user->id, $session);
            }
        endif;
    }

    //removes older sessions

    /**
     * @param $userid
     * @param $sessions
     */
    protected function removeOtherSession($userid, $sessions)
    {
        $this->disableSession($sessions);
        $this->removeUserSession($userid);
        $this->response = array(
            'status' => 'error',
            'status_code' => 200,
            'message' => 'Logged in from another Browser',
        );
    }

    //disables the sessions

    /**
     * @param $sessions
     */
    protected function disableSession($sessions)
    {
        foreach ($sessions as $session) {
            $session->is_active = false;
            $session->save();
        }
    }

    /**
     * @return bool
     */
    protected function checkActivity()
    {
        return true;
    }

    /**
     * @param $message
     */
    protected function removeLogin($message)
    {
        $this->userlog->is_active = false;

        $this->userlog->save();
        $this->removeUserSession($this->userlog->user_id);
        Auth::guard()->logout();
        $this->response = array(
            'status' => 'error',
            'status_code' => 200,
            'message' => $message,
        );
    }

    /**
     * @param $id
     * @return $this
     */
    public function kickOut($id)
    {
        $user = User::find($id);
        $userlogs = $user->userlogs;
        foreach ($userlogs as $userlog) {
            if ($userlog->is_active) {
                $userlog->is_active = false;
                $userlog->save();
            }
        }
        $this->removeUserSession($id);
        $this->kickedOutResponse();
        return $this;
    }

    /**
     * @param $client
     * @param $user
     */
    public function store($client, $user)
    {
        $userlog = new UserLog();
        $userlog->user_id = $user->id;
        $userlog->login_timestamp = Carbon::now();
        $userlog->last_login_timestamp = Carbon::now();
        $userlog->last_call_timestamp = Carbon::now();
        /*  foreach ($index as $key => $val) {
        if (array_key_exists($key, $client)) {
        $userlog->$key = $val;
        }
        }*/
        if (array_key_exists('fingerprint', $client)) {
            $userlog->fingerprint = $client['fingerprint'];
        }

        if (array_key_exists('browser', $client)) {
            $userlog->browser = $client['browser'];
        }

        if (array_key_exists('os', $client)) {
            $userlog->os = $client['os'];
        }

        if (array_key_exists('cpu', $client)) {
            $userlog->cpu = $client['cpu'];
        }

        if (array_key_exists('location', $client)) {
            $userlog->location = $client['location'];
        }

        $userlog->save();

        session()->put('loggedin_id', $userlog->id);
    }

    /**
     * @param $id
     */
    protected function removeUserSession($id)
    {
        DB::table('sessions')->where('user_id', $id)->delete();
    }

    /**
     * @param array $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     *Sets the Response value to Inactive
     */
    protected function sessionInactiveResponse()
    {
        $this->response = array(
            'status' => 'error',
            'status_code' => 200,
            'ping_gap' => $this->pingtime,
            'message' => 'Your Session has Expired',
        );
    }

    /**
     *Sets the Response value to Kicked off
     */
    protected function kickedOutResponse()
    {
        $this->response = array(
            'status' => 'error',
            'status_code' => 200,
            'ping_gap' => $this->pingtime,
            'message' => 'You have been Logged out by System Admin',
        );
    }

    /**
     * Sets the Response value to Success
     */
    protected function successfulResponse()
    {
        $this->response = array(
            'status' => 'success',
            'status_code' => 200,
            'ping_gap' => $this->pingtime,
            'message' => 'Ping Successful',
        );
    }

    /**
     * @return bool
     */
    public function cleanUpSessions()
    {
        if ($sessions = $this->getActiveSessions()) {
            $this->cleanUp($sessions);
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    protected function getActiveSessions()
    {
        return UserLog::where('is_active', true)->get();
    }

    /**
     * @param $sessions
     */
    protected function cleanUp($sessions)
    {
        foreach ($sessions as $session) {
            $this->checkTime($session);
        }
    }

    /**
     * @param UserLog $session
     */
    protected function checkTime(UserLog $session)
    {
        $now = Carbon::now();
        $before = $session->last_call_timestamp;

        if ($now->diffInMinutes($before) >= $this->pingtime) {
            $session->is_active = false;
            $session->save();
            $this->sessionInactiveResponse();
            $this->removeUserSession($session->user_id);
        }
    }
}
