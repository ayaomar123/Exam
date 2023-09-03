<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        /*create  3 aacounts*/
        Account::query()->create([
            'user_id' => $user->id,
            'currency' => 'EUR',
            'number' => rand(10000, 99999) . '-' . 'EUR',
            'balance' => 0
        ]);

        Account::query()->create([
            'user_id' => $user->id,
            'currency' => 'USD',
            'number' => rand(10000, 99999) . '-' . 'USD',
            'balance' => 0
        ]);

        Account::query()->create([
            'user_id' => $user->id,
            'currency' => 'JOD',
            'number' => rand(10000, 99999),
            'balance' => 0
        ]);

//        dd('tst');

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
