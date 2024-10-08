<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Notifications\ResetGoogle2fa;
class Google2FaController extends Controller
{
    function index(Request $request)
    {
        $user = User::where('uuid', $request->session()->get('2fa:user_id'))->first();
        if (!$user) {
            return redirect()->route('login');
        }
        $google2fa = new Google2FA();
        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();
        $registration_data['email'] = $user->email;

        $request->session()->put('registration_data', $registration_data);
        $QR_Image = $google2fa->getQRCodeUrl(
            config('app.name'),
            $registration_data['email'],
            $registration_data['google2fa_secret']
        );

        return view('google2fa.register', [
            'QR_Image' => $QR_Image,
            'secret' => $registration_data['google2fa_secret']
        ]);
    }

    function sendmail(Request $request) {
        $user = User::where('uuid',$request->session()->get('2fa:user_id'))->first();
        if (!$user) {
            return redirect()->route('login');
        }


        $user->notify(new ResetGoogle2fa($user));
        return view('google2fa.mailsent');

    }

    function resetandregister(User $user, Request $request) {
        $request->session()->remove('2fa:user_id');
        $request->session()->remove('registration_data');

        $user->google2fa_secret = null;
        $user->first_time_login = true;
        $user->save();

        flash('Sila log masuk semula untuk pendaftaran Google Authenticator')->success()->important();
        return redirect()->route('login');
    }

    function completeRegister(Request $request) {
        $user = User::where('email', $request->email)->first();
        $user->first_time_login = false;
        $user->google2fa_secret = $request->google2fa_secret;
        $user->save();

        return redirect()->route('google2fa.verifyForm');
    }

    function verifyForm(Request $request)
    {
        $user = User::where('uuid',$request->session()->get('2fa:user_id'))->first();
        if (!$user) {
            return redirect()->route('login');
        }
        return view('google2fa.verify');
    }

    function verify(Request $request)
    {
        $user = User::where('uuid',$request->session()->get('2fa:user_id'))->first();

        $this->validate($request, [
            'one_time_password' => 'required',
        ]);

        if ($user) {
            $google2fa = app('pragmarx.google2fa');
            $valid = $google2fa->verifyKey($user->google2fa_secret, $request->one_time_password);

            if ($valid) {
                $request->session()->forget('2fa:user_id');
                Auth::login($user);
                $request->session()->remove('2fa:user_id');
                $request->session()->remove('registration_data');
                return redirect()->route('home');
            }
        }

        return redirect()->back()->withErrors(['one_time_password' => 'Invalid one time password']);
    }

    public function completeRegistration(Request $request)
    {
        $request->merge(session('registration_data'));

        return $this->completeRegister($request);
    }


}
