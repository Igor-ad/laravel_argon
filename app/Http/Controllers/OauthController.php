<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $user = Socialite::driver('github')->user();
        $this->login($user);
        return redirect()->route('home');
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->login($user);
        return redirect()->route('home');
    }

    private function login($oauth)
    {
        $user = User::firstOrCreate(
            [
                'email' => $oauth->getEmail()
            ],
            [
                'name' => $oauth->getName(),
                'email' => $oauth->getEmail(),
                'password' => Hash::make(Str::random(25))
            ]
        );
        Auth::login($user);
    }
}
