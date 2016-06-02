<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use App\User;

class SocialAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $facebook_user = Socialite::driver('facebook')->user();

        //Check is this email present
        $userCheck = User::where('email', '=', $facebook_user->getEmail())->first();
        if(!empty($userCheck)){
            $socialUser = $userCheck;
        } else {
            $socialUser = User::create([
                'id_facebook' => $facebook_user->getId(),
                'name' => $facebook_user->getName(),
                'email' => $facebook_user->getEmail(),
                'avatar' => $facebook_user->getAvatar(),
                'token' => $facebook_user->token,
            ]);
        }

//        Auth::loginUsingId($socialUser->id);
        Auth::login($socialUser, true);
//        dd(Auth::check());
//        dd(Auth::user()->id);
//        dd($result);

        return redirect('/home/#');

    }

    public function logout()
    {
        Auth::logout();

        //dd("logging out!!!!");

        //Auth::logout();
        return redirect('/');

//        return redirect()->route('auth.login')
//            ->with('status', 'success')
//            ->with('message', 'Logged out');

    }
}