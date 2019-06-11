<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use App\User;

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

    /**
         * Redirect the user to the GitHub authentication page.
         *
         * @return \Illuminate\Http\Response
         */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

        /**
         * Obtain the user information from facebook.
         *
         * @return \Illuminate\Http\Response
         */
        public function handleProviderCallback()
        {
            $facebookUser = Socialite::driver('facebook')->user();

            $user = User::where('provider_id', $facebookUser->getId())->first();

            if (!$user) {
                $user = User::create([
                    'email' => $facebookUser->getEmail(),
                    'name' => $facebookUser->getEmail(),
                    'provider_id' => $facebookUser->getId(),
                    'provider' => 'Facebook'
                ]);

                $user->roles = 'F.User';
            }

            Auth::login($user, true);

            return redirect($this->redirectTo);
        }
    }