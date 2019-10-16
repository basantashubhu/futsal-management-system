<?php

namespace App\Models;

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

    public function userlogs()
    {
        return $this->hasMany(UserLog::class);
    }

    public function developersNotes()
    {
        return $this->hasMany(DeveloperNote::class);
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
