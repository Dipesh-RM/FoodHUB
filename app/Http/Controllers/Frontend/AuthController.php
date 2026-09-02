<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;

class AuthController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        $user = Socialite::driver('google')->user();
        $existUser = User::where('email',$user->email)->first();
         if(!$existUser){
            $existUser = new User();
            $existUser->name = $user->name;
            $existUser->email = $user->email;
            $existUser->password = Hash::make(rand(33333,99999));
            $existUser->save();
         }
    Auth::login($existUser);

    return redirect('/');
        // $user->token
    }
     public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the current session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
