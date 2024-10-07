<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class SocialAuthController extends Controller
{
    //

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $this->findOrCreateUser($user, 'google');
            return redirect()->intended('/home');
        } catch (\Exception $e) {
            return redirect('/login');
        }
    }
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();
            $this->findOrCreateUser($user, 'facebook');
            return redirect()->intended('/home');
        } catch (\Exception $e) {
            return redirect('/login');
        }
    }

    // Common logic to create or retrieve user
    public function findOrCreateUser($socialUser, $provider)
    {
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
'password' => bcrypt(Str::random(8)),
            ]);
        }

        Auth::login($user, true);
        return redirect('/home'); // أو أي وجهة أخرى
    }
    

}
