<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    // 1. Redirect user ke halaman login Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Handle callback dari Google
    public function callback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            if(!$user){
                // Jika user belum ada, buat baru
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('password_acak_123') // Atau biarkan null
                ]);
            } else {
                // Jika user ada tapi belum punya google_id (misal dulu daftar manual), update id-nya
                $user->update([
                    'google_id' => $googleUser->getId(),
                ]);
            }

            // Login user tersebut
            Auth::login($user);

            return redirect()->to('/products'); // Ganti dengan halaman tujuanmu

        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', 'Login Gagal!');
        }
    }
}