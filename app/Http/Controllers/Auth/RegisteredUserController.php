<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['required', 'string', 'size:10'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'signup_terms' => ['in:1'],
        ],[
            'signup_terms.in' => "You didn't check I agree."
        ]);

        $temp = Str::random(10);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile ?? null,
            'username' => $request->username,
            'password' => Hash::make($temp),
            'temp' => $temp,
        ]);

        $user->assignRole(RoleEnum::User->value);

        event(new Registered($user));

        return view('auth.verify-email', compact('user'));
        /*Auth::login($user);

        return redirect(RouteServiceProvider::HOME);*/
    }
}
