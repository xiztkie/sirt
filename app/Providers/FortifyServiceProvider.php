<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        Fortify::authenticateUsing(function (Request $request) {
            $request->validate([
                'login' => ['required', 'string'],
                'password' => ['required', 'string'],
                'captcha' => ['required', 'string'],
            ]);

            if ($request->captcha !== session('captcha_code')) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'captcha' => 'Kode captcha tidak cocok!',
                ]);
            }
            $user = User::where('email', $request->login)
                ->orWhere('username', $request->login)
                ->first();

            if ($user && Hash::check($request->password, $user->password)) {
                session()->forget('captcha_code');

                return $user;
            }
            return null;
        });

        Fortify::loginView(function () {
            return view('login');
        });
    }
}
