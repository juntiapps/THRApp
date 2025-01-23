<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GoogleUser;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; // Import model User Anda
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str; // Import Str class

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            // Log::info('Google User Response:', $user->getRaw());
            // dd($user);
        } catch (\Exception $e) {
            // dd($e);
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.'); // Redirect ke halaman login dengan pesan error
        }

        $findUser = User::where('google_id', $user->id)->first();

        // dd($user->id);
        if ($findUser) {
            Auth::login($findUser);
            return redirect('/home'); // Redirect ke halaman home setelah login berhasil
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => Hash::make(Str::random(16)),
                'avatar'=> $user->avatar
                // tambahkan kolom lain yang diperlukan
            ]);

            Auth::login($newUser);
            return redirect('/home'); // Redirect ke halaman home setelah registrasi dan login berhasil
        }
    }
}