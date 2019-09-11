<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request)
    {

        if ($this->validateRequest($request)) {
            $user = $this->getUser($request->email);
            $this->resetPassword($user, $request->password);

            return redirect('/');
        }
        
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans('passwords.user')]);
    }

    protected function resetPassword($user, $password)
    {
        $user->password = \Hash::make($password);

        // $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        // return $this->guard()->login($user);
        return \Auth::attempt(['email' => $user->email, 'password' => $password]);
    }

    public function validateRequest(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());
        $email = $request->email;
        $token = $request->token;
        if ($token1 = DB::table('password_resets')->where('email', $email)->latest()->first()) {
            $token1 = $token1->token;
            return $token1 == $token;
        }
        return false;
    }

    public function getUser($email)
    {
        return User::where('email', $email)->first();
    }
}
