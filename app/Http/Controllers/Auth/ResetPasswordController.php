<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

use App\User;
use App\PasswordReset as PasswordResetModel;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
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
    const ERROR_MESSAGE_INVALID_TOKEN = 'Invalid token';
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $password_reset = PasswordResetModel::where('email', '=', $request->email)->firstOrFail();
        if (!Hash::check($token, $password_reset->token)) {
            $error_message = self::ERROR_MESSAGE_INVALID_TOKEN;
            return redirect("/error?errorMessage={$error_message}");
        }

        $token = User::genResetPasswordToken();
        $user = User::where('email', '=', $request->email)->firstOrFail();
        $user->setRememberTokenAttribute($token);
        $user->save();
        return redirect("/password/reset?token={$token}&email={$request->email}");
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.

        $response = $this->broker(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        // 手動改寫過
        return $response == Password::PASSWORD_RESET 
                    ? response()->json([],200)
                    : response()->json(['errors' =>['email' => [trans($response)]]], 422);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);
        //避免token重複使用
        $user->setRememberTokenAttribute(User::genResetPasswordToken()); 
        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker(array $credentials, Closure $callback)
    {
        $user = User::where('email', $credentials['email'])
                    ->first();

        if(is_null($user) || !Hash::check($credentials['token'], $user->remember_token)){
            return Password::INVALID_TOKEN;
        }
        $this->resetPassword($user, $credentials['password']);
        return Password::PASSWORD_RESET;
    }


}
