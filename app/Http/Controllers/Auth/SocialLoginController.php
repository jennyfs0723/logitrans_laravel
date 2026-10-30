<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
    /**
     * Redirige al usuario a la página de autenticación de Google.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtiene la información del usuario desde Google tras la autenticación.
     */
    public function callback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Hubo un problema al autenticar con Google.');
        }

        // Busca si el usuario ya existe por su correo, o lo crea de cero si no existe
        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'password' => bcrypt(Str::random(24)), // Contraseña aleatoria segura requerida por Laravel
            ]
        );

        Auth::login($user);

        return redirect('/home'); 
    }
}

