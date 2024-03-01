<?php

namespace App\Http\Controllers;

use App\Models\SocialUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function auth()
    {
        return view("auth.social");
    }

    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
        // return Socialite::driver($provider)->redirect;
    }

    public function callback(string $provider)
    {   
        $providedUser = Socialite::driver($provider)->stateless()->user();
        $socialUser = SocialUser::where('provider_user_id', $providedUser->getId())->first();

        // dd($socialUser);

        if($socialUser == null) {
            // only creates
            $socialUser = SocialUser::firstOrCreate([
                'provider' => 'facebook',
                'provider_user_id' => $providedUser->getId(),
                'token' => $providedUser->token,
            ]);
        }
        // dd($socialUser);
        if($socialUser->user_id == null){
            $user = User::create([
                'name' => $providedUser->getName(),
                'email' => $providedUser->getEmail(),
                'password' => 'social_password', 
            ]);
            $socialUser->user()->associate($user)->save();
        }

        Auth::loginUsingId($socialUser->user_id);

        return redirect("/dashboard");

    }
}
