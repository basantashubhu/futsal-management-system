<?php


namespace App\Models;

use App\Models\Fgp\Site;
use App\Models\Fgp\Volunteer;
use App\Models\Organization;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function reportingMgr()
    {
        return $this->belongsToMany(self::class, 'user_rpt_mgr', 'user_id', 'rpt_mgr_id')
            ->select(['users.id', 'users.alt_id', 'users.name', 'users.email', 'users.role_id']);
    }

    public function reportingMgrOf()
    {
//        return $this->hasMany(self::class, 'rpt_mgr_id')
        //            ->select(['users.id', 'users.alt_id', 'users.name', 'users.email', 'users.role_id']);
        return $this->belongsToMany(self::class, 'user_rpt_mgr', 'rpt_mgr_id', 'user_id')
            ->select(['users.id', 'users.alt_id', 'users.name', 'users.email', 'users.role_id']);
    }

    /**
     * volunteer of user
     * This is outdated
     */
    public function volunteer()
    {return $this->hasOne(Volunteer::class, 'user_id', 'id');
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'volunteers_supervisors', 'supervisor_id', 'volunteer_id')
            ->where('volunteers.is_deleted', 0);
    }

    // reporting manager of auth not current user object
    public function getReportingMgr()
    {

        if (count(auth()->user()->reportingMgrOf)) {
            return auth()->user()->reportingMgrOf->map(function ($user) {
                return $user->id;
            })->push(auth()->id())->unique();
        } else {
            return [auth()->id()];
        }

        // $rptMgr = auth()->user()->reportingMgrOf()->select('users.id', 'users.rpt_mgr_id')->with(['reportingMgrOf' => function($u) {
        //     $u->select('id', 'rpt_mgr_id');
        // }])->get()->map(function($user) {
        //     return $user->reportingMgrOf->pluck('id')->push($user->id);
        // })->collapse()->push(auth()->id())->unique()->all();

        // return $rptMgr;

    }

    public function getVolunteers()
    {
        $rptMgr = $this->getReportingMgr();

        return Volunteer::whereHas('supervisors', function ($sup) use ($rptMgr) {
            $sup->whereIn('volunteers_supervisors.supervisor_id', $rptMgr);
        })->get();
    }

    /**
     * system user as member
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function self()
    {
        return $this->hasOne(Member::class, 'user_id', 'id');
    }
    public function member()
    {
        $member = $this->self;
        if (!$member):
            save_update(app(Member::class), array(
                'first_name' => $this->name,
                'last_name' => '',
                'user_id' => $this->id,
            ));
        endif;
        return $this->self();
    }

    public function fullName()
    {

        return $this->self ? $this->self->fullName() : $this->name;

    }

    public function client()
    {
        return $this->hasOne(Client::class, 'user_id');
    }

    public function hasRole($roleName)
    {
        return ($this->role && ($this->role->name == $roleName || $this->role->label == $roleName)) ? true : false;
    }

    public function settings()
    {
        return $this->hasMany(UserSettings::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function communicationpreference()
    {
        return $this->hasOne(CommunicationPrefrence::class);
    }

    public function userlogs()
    {
        return $this->hasMany(UserLog::class);
    }

    public function developersNotes()
    {
        return $this->hasMany(DeveloperNote::class);
    }

    public function emailsettings()
    {
        return $this->hasOne(EmailSettingsModel::class, 'user_id');
    }

    public function checkPermission($page, $action)
    {
        // $request = new Request();
        $permissions = session('permission');
        if (!$permissions instanceof Collection && !is_array($permissions)) {
            $this->regenerateSession(request());
            $permissions = session('permission');
        }
        /* if (is_null($permissions)) {
        return $this->useRemember($request);
        } */

        if (Auth::user()->role_id == 1):
            return true;
        else:
            foreach ($permissions as $key => $value) {
                $actionList = explode('|', $value->action);
                if ((strtolower($value->page_name) == strtolower($page))) {
                    if (in_array($action, $actionList)) {
                        return true;
                    }
                }

            }
        endif;

        return false;
    }

    public function useRemember($request)
    {
        $email = Cookie::get('email');
        $password = Cookie::get('password');
        if (($email && $password)):
            $field = filter_var($email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
            Auth::attempt([$field => $email, 'password' => $password], true);

            $role = Auth::user()->role_id;
            $user = Auth::id();

            session(['permission' => $this->getAllPermission($role, $user)]);
            return redirect('/');
        else:
            session()->invalidate();
            Auth::guard()->logout();
            return redirect('/login');
        endif;
    }
    public function checkSettings($code)
    {
        $settings = $this->settings();
        foreach ($settings as $setting) {
            if ($setting->code == $code) {
                return $setting->is_true;
            }

        }
        return false;
    }

    public function communicationby($key)
    {

        if ($preference = $this->communicationpreference) {
            if ($preference->$key) {
                return true;
            }

        }
        return false;
    }

    public function organization()
    {
        $client = $this->client;
        if ($client) {
            return $client->organization;
        }

        return null;
    }

    protected function getAllPermission($role, $user)
    {
        $permission = DB::table('role_permission')
            ->join('permissions', 'permissions.id', 'role_permission.permission_id')
            ->join('pages', 'pages.id', 'permissions.page_id')
            ->select('permissions.name', 'permissions.action', 'pages.page_name')
            ->where('role_permission.role_id', $role);

        $permissions = DB::table('user_permission')
            ->join('permissions', 'permissions.id', 'user_permission.permission_id')
            ->join('pages', 'pages.id', 'permissions.page_id')
            ->select('permissions.name', 'permissions.action', 'pages.page_name')
            ->where('user_permission.users_id', $user)
            ->union($permission)
            ->get();

        return $permissions;
    }

    public function managerSites()
    {

        return $this->belongsToMany(Site::class, 'site_managers', 'user_id', 'site_id');
    }

    /**
     * @param array|callable $selectables
     * @param array $relSelectable
     * @return Site[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed[]
     */
    public function sites($selectables = ['*'], $relSelectable = ['*'])
    {

        $rptMgr = $this->hierarchyIds()->all();
        $rel = [];
        if (count($relSelectable)) {
            $rel['address'] = function ($rel) use ($relSelectable) {$rel->select($relSelectable);};
        }

        $query = Site::when(count($rel) ? $rel : false, function ($query, $rel) {
            $query->with($rel);
        })
            ->unless((auth()->user()->role_id === 7 || auth()->user()->role_id === 1), function ($query) use ($rptMgr) {
                $query->whereHas('users', function ($users) use ($rptMgr) {
                    $users->whereIn('users.id', $rptMgr);
                });
            });

        if (is_callable($selectables)) {
            $selectables($query);
        }

        return $query->when(!is_callable($selectables), function ($query) use ($selectables) {
            $query->select($selectables);
        })->get();
    }

    public function hasSite($id)
    {
        $rptMgr = $this->hierarchyIds()->all();

        if (isset($this->hasSites)) {
            return $this->hasSites->contains($id);
        }
        $this->hasSites = Site::whereRaw('exists (select site_id from site_managers where user_id in (' . implode(',', $rptMgr) . ') and site_id = sites.id and site_managers.is_deleted = 0)')
            ->where('sites.id', $id)
            ->pluck('sites.id');

        return $this->hasSite($id);
    }

    public function hierarchyIds()
    {
        return $this->reportingMgrOf()->with('reportingMgrOf')->get()
            ->map(function ($user) {
                return $user->reportingMgrOf->pluck('id')->push($user->id);
            })
            ->collapse()->push($this->id)
            ->unique();
    }

    public function default_counties()
    {
        return $this->hasMany(UserSettings::class, 'user_id')
            ->where('type', 'default_counties');
    }

    public function notes()
    {
        return $this->hasMany(\App\Models\Note::class, 'userc_id');
    }

    public function reminderNotes()
    {
        return $this->notes()->where('note_type', 'reminder')->where('is_completed', 0);
    }

    public function todoNotes()
    {
        return $this->notes()->where('note_type', 'todo')->where('is_completed', 0);
    }

    /*============= jwt ================*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @return array
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function regenerateSession($request)
    {
        //check if user set remember Token
        if ($request->has('remember')) {
            Cookie::queue(Cookie::make('email', $request->email, 45000));
            Cookie::queue(Cookie::make('password', $request->password, 45000));
        } else {
            Cookie::queue(Cookie::forget('email'));
            Cookie::queue(Cookie::forget('password'));
        }

        $role = Auth::user()->role_id;
        $user = Auth::id();

        session(['permission' => $this->getAllPermission($role, $user)]);
    }
}
