<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailVerificationRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request, $id)
    {
        $user = User::find($id);

        if (! $user->password_change_at) {
            $user->markEmailAsVerified();
            Auth::login($user);

            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
