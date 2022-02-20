<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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
    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function facebook_callback()
    {
        try {

            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            /// lakukan pengecekan apakah facebook id nya sudah ada apa belum
            $isUser = User::where('facebook_id', $facebookUser->id)->first();
            if($isUser){
                Auth::login($isUser);
                return redirect(route('home'));
            } else {
                $checkEmail = User::where('email', $facebookUser->email)->first();
                if ($checkEmail) {
                    if ($checkEmail->google_id !== null) {
                        session()->flash('warning',sprintf(__('auth.please_login_facebook'), $facebookUser->email ) );
                    } else {
                        session()->flash('warning',sprintf(__('auth.please_login'), $facebookUser->email ));
                    }
                    return redirect(route('login'));
                }

                $newUser = \App\Models\User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'password' => Hash::make($facebookUser->getName() . rand(111111,999999)),
                    //'email_verified_at' => \Carbon\Carbon::now(),
                    'facebook_id' => $facebookUser->getId(),
                ]);
                //dd('stop');
                $userId = $newUser->id;
                $newUser->email_verified_at = \Carbon\Carbon::now();
                $newUser->update();
                Auth::login($newUser);
                return redirect(route('home'));
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function google_callback()
    {
        try {

            $googleUser = Socialite::driver('google')->stateless()->user();
            /// lakukan pengecekan apakah facebook id nya sudah ada apa belum
            $isUser = User::where('google_id', $googleUser->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect(route('home'));
            } else {
                $checkEmail = User::where('email', $googleUser->email)->first();
                if ($checkEmail) {
                    if ($checkEmail->facebook_id !== null) {
                        session()->flash('warning',sprintf(__('auth.please_login_facebook'), $googleUser->email ) );
                    } else {
                        session()->flash('warning',sprintf(__('auth.please_login'), $googleUser->email ));
                    }
                    return redirect(route('login'));
                }


                $newUser = \App\Models\User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make($googleUser->name . rand(111111,999999)),
                    //'email_verified_at' => \Carbon\Carbon::now(),
                    'google_id' => $googleUser->id,
                ]);
                //dd('stop');
                $userId = $newUser->id;
                $newUser->email_verified_at = \Carbon\Carbon::now();
                $newUser->update();

                Auth::login($newUser);
                return redirect(route('home'));
            }
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }


}
