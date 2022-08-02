<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    public function edit(User $user): View|RedirectResponse
    {
        if(auth()->id() != $user->id) {
            return to_route('home.index');
        }

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'mobile' => ['nullable', 'string', 'size:10'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id),],
        ]);

        if($user->id !== auth()->user()->id) {
            return to_route('profile.edit')
                ->with('error', __('messages.update-not-allowed'));
        }

        $updated = auth()->user()->update($data);

        if(!$request->has('password')){
            return to_route('profile.edit', $user)
                ->withSuccess(__('custom-messages.model-updated', ['model' => 'profile']));
        }

        $data = $request->validate([
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        /*if($request->new_email && auth()->user()->email !== $request->new_email) {
            auth()->user()->newEmail($request->new_email);

            return to_route('profile.edit', $user)
                ->withSuccess(__('profile.new-email-updated'));
        }*/

        return to_route('profile.edit', $user)
            ->withSuccess(__('custom-messages.model-updated', ['model' => 'profile']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
