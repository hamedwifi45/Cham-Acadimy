<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Socialite;

class SocialiteController extends Controller
{
     public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)->first();

            $avatarUrl = $googleUser->getAvatar();
            $avatarContents = file_get_contents($avatarUrl);
            $filename = 'avatar_' . $googleUser->getId() . '.jpg';

            Storage::put('public/profile-photos/' . $filename, $avatarContents);
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(24)), // كلمة مرور عشوائية
                    'profile_photo_path' => 'profile-photos/' . $filename,
                ]);
            }
            

            Auth::login($user);

            return redirect('/');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors('فشل تسجيل الدخول عبر جوجل');
        }
    }
     public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            $user = User::where('facebook_id', $facebookUser->id)->first();

            $avatarUrl = $facebookUser->getAvatar();
            $avatarContents = file_get_contents($avatarUrl);
            $filename = 'avatar_' . $facebookUser->getId() . '.jpg';

            Storage::put('public/profile-photos/' . $filename, $avatarContents);
            if (!$user) {
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'password' => bcrypt(Str::random(24)), // كلمة مرور عشوائية
                    'profile_photo_path' => 'profile-photos/' . $filename,
                ]);
            }
            

            Auth::login($user);

            return redirect('/');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors('فشل تسجيل الدخول عبر جوجل');
        }
    }
}
