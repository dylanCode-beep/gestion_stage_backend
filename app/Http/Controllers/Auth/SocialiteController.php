<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MessageGoogle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback(){
        try{
            $googleUser = Socialite::driver('google')->stateless()->user();
            $password = Str::random(8);
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => Hash::make($password),
                    'google_id' => $googleUser->getId(),
                ]
                );

                Mail::to($user->email)->send(new MessageGoogle($user,$password));
                

                Auth::login($user);

                $token = $user->createToken('API Token')->plainTextToken;
                return redirect("http://localhost:5175/login-success?token=$token");

        }catch(\Exception $e){
            return response()->json(['Error' => 'Erreur google OAuth', 'message' => $e->getMessage()],500);
        }
    }
}
