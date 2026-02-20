<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use DragonCode\Support\Facades\Helpers\Str;
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
            if (! $user) {
                $user = User::where('email', $googleUser->email)->first();
            }
            if (! $user) {
                $avatarUrl = $googleUser->getAvatar();
                $avatarContents = file_get_contents($avatarUrl);
                $filename = 'avatar_'.$googleUser->getId().'.jpg';
                Storage::put('public/profile-photos/'.$filename, $avatarContents);

                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(24)),
                    'profile_photo_path' => 'profile-photos/'.$filename,
                ]);
            } else {
                $avatarUrl = $googleUser->getAvatar();
                $avatarContents = file_get_contents($avatarUrl);
                $filename = 'avatar_'.$googleUser->getId().'.jpg';
                Storage::put('public/profile-photos/'.$filename, $avatarContents);
                $user->update([
                    'google_id' => $googleUser->id,
                    'profile_photo_path' => 'profile-photos/'.$filename,
                    'name' => $googleUser->name,
                ]);
            }
            Auth::login($user);

            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('فشل تسجيل الدخول عبر جوجل: '.$e->getMessage());
        }
    }
}
