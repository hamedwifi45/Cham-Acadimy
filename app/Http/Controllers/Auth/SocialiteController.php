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

    // معالجة العودة من Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // البحث عن المستخدم في قاعدة البيانات
            $user = User::where('google_id', $googleUser->id)->first();

            $avatarUrl = $googleUser->getAvatar();
            $avatarContents = file_get_contents($avatarUrl);
            $filename = 'avatar_' . $googleUser->getId() . '.jpg';

            Storage::put('public/profile-photos/' . $filename, $avatarContents);

            // dd($googleUser);
            // إذا لم يوجد، ننشئه
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(24)), // كلمة مرور عشوائية
                    'profile_photo_path' => 'profile-photos/' . $filename,
                ]);
            }
            

            // تسجيل الدخول
            Auth::login($user);

            return redirect('/');

        } catch (\Exception $e) {
            return redirect('/login')->withErrors('فشل تسجيل الدخول عبر جوجل');
        }
    }
}
