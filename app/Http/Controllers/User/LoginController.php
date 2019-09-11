<?php


namespace App\Http\Controllers\User;


use App\Events\UserLoggedin;
use App\Http\Controllers\Controller;
use App\Models\UserLog;
use App\Models\LayoutBuilder;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $request->merge([$field => $request->input('email')]);

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request, $field)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request, $field)
    {
        return $this->guard()->attempt(
            $request->only($field, 'password'), $request->filled('remember')
        );
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    protected function authenticated(Request $request, $userlogged)
    {
        //check if user set remember Token
       if($request->has('remember'))
       {
           Cookie::queue(Cookie::make('email',$request->email,45000));
           Cookie::queue(Cookie::make('password',$request->password,45000));
       }
       else
       {
           Cookie::queue(Cookie::forget('email'));
           Cookie::queue( Cookie::forget('password'));
       }


        $role = Auth::user()->role_id;
        $user = Auth::id();
        event(new UserLoggedin($request->all(), $userlogged));

        session(['permission' => $this->getAllPermission($role, $user)]);

        $this->initDefaultSetting();
    }

    private function initDefaultSetting()
    {
        $setting = array(
            1 => array(
                'layout_type' => 'fluid'
            ),
            2 => array(
                'page_background' => 'lightgray'
            ),
            3 => array(
                'desktop_fixed_header' => "on"
            ),
            4 => array(
                'desktop_header_minimize_mode' => 'none'
            ),
            5 => array(
                'mobile_fixed_header' => "on"
            ),
            6 => array(
                'display_header_menu' => "on"
            ),
            7 => array(
                'dropdown_skin' => 'light'
            ),
            8 => array(
                'display_submenu_arrow' => "on"
            ),
            9 => array(
                'aside_skin' => 'dark'
            ),
            10 => array(
                'fixed_aside' => "on"
            ),
            11 => array(
                'allow_aside_minimizing' => "off"
            ),
            12 => array(
                'default_minimized_aside' => "off"
            ),
            13 => array(
                'default_hidden_aside' => "off"
            ),
            14 => array(
                'fixed_footer' => "off"
            ),
            15 => array(
                'global_page_background' => 'none'
            )
        );

        $hasSetting = LayoutBuilder::where('user_id', Auth::id())->exists();

        if(!$hasSetting) {
            foreach($setting as $key => $value) {
                $builder = new LayoutBuilder();
                $builder->user_id = Auth::id();
                $builder->setting_label = key($value);
                $builder->applied_value = $value[key($value)];
                $builder->save();
            }
        }
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

    public function logout(Request $request)
    {
        $this->invalidUserLog();
        $this->guard()->logout();
        Cookie::queue(Cookie::forget('pet_registration'));
        Cookie::queue(Cookie::forget('application'));
        Cookie::queue(Cookie::forget('service_provider'));
        Cookie::queue(Cookie::forget('invoice'));
        Cookie::queue(Cookie::forget('application_open'));
        Cookie::queue(Cookie::forget('pet_registration_quick'));
        Cookie::queue(Cookie::forget('invoice_quick'));
        Cookie::queue(Cookie::forget('service_provider_quick'));
        Cookie::queue(Cookie::forget('payment'));
        Cookie::queue(Cookie::forget('payment_quick'));
        Cookie::queue(Cookie::forget('users'));
        Cookie::queue(Cookie::forget('table_main'));
        Cookie::queue(Cookie::forget('site_advanced'));
        Cookie::queue(Cookie::forget('site_quick'));
        Cookie::queue(Cookie::forget('volunteers_advanced'));
        Cookie::queue(Cookie::forget('volunteers_quick'));
        Cookie::queue(Cookie::forget('volunteer_detail'));
        Cookie::queue(Cookie::forget('time_sheet'));
        Cookie::queue(Cookie::forget('time_sheet_advanced'));
        Cookie::queue(Cookie::forget('time_sheet_advanced_1'));
        Cookie::queue(Cookie::forget('zip_code'));
        Cookie::queue(Cookie::forget('stipend_item'));
        Cookie::queue(Cookie::forget('email_log'));

        $request->session()->invalidate();

        return redirect('/login');
    }

    protected function invalidUserLog()
    {
        $id = session('loggedin_id');
        if ($userlog = UserLog::find($id)):
            $userlog->is_active = false;
            $userlog->save();
        endif;
        session()->forget('loggedin_id');
    }

}