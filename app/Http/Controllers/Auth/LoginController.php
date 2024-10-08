<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        $request->session()->forget('2fa:user_id');
        $request->session()->forget('registration_data');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if(env('APP_DEBUG') ) {
            if(Auth::attempt($credentials)) {
                $user = Auth::getProvider()->retrieveByCredentials($credentials);
                Auth::login($user);
                return redirect()->route('home');
            }
        }else{
            if (Auth::validate($credentials)) {
                $user = Auth::getProvider()->retrieveByCredentials($credentials);

                if(Cookie::get('trustdevice') == $user->uuid) {
                    Auth::login($user);
                    return redirect()->route('home');
                }else{
                    $request->session()->put('2fa:user_id', $user->uuid);
                    Cookie::queue(Cookie::forget('trustdevice'));
                    if ($user->first_time_login) {
                        return redirect()->route('google2fa.register');
                    } else {
                        return redirect()->route('google2fa.verifyForm');
                    }
                }
            }
        }

        // if ($this->attemptLogin($request)) {
        //     if ($request->hasSession()) {
        //         $request->session()->put('auth.password_confirmed_at', time());
        //     }

        //     return $this->sendLoginResponse($request);
        // }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
