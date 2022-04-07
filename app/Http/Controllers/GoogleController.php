<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Mengarahkan proses authentikasi menggunakan google OAuth.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback authentikasi google. 
     * Jika sudah memiliki akun otomatis login.
     * Jika belum memiliki akun maka otomatis dibuatkan akun kemudian login.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
    
            $finduser = User::where('google_id', $user->id)->first();
    
            if($finduser){
    
                Auth::login($finduser);
    
                return redirect()->intended('dashboard');
    
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                $token = $newUser->createToken('JTI-Test-Token');
                $newUser->api_token = $token->plainTextToken;
                $newUser->save();
    
                Auth::login($newUser);
    
                return redirect()->intended('dashboard');
            }
    
        } catch (Exception $e) {
            abort(404);
        }
    }
}
