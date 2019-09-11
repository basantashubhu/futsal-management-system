<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Email\ForgotPassword;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function sendResetLinkEmail(Request $request)
    {

        /*Check if user of that email exits*/
        $this->validateEmail($request);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(["error" => "Email doesn't exists"], 422);
        }

        $token = $this->generateToken($request->email);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.

        $response = $this->sendResetEmail($request->email, $token, $user->name);

        return $response == Password::RESET_LINK_SENT
        ? $this->sendResetLinkResponse($response)
        : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function generateToken($email)
    {
        $token = random_string();
        DB::table('password_resets')->insert(array(
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ));
        return $token;

    }

    protected function sendResetEmail($email, $token, $name)
    {
        Mail::to($email)->send(new ForgotPassword($email, $token, $name));
        return 'passwords.sent';

    }
}
