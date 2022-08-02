<?php

namespace App\Actions\Users;

use App\Enums\RoleEnum;
use App\Enums\UserStatusEnum;
use App\Interfaces\Actions\Users\CreatesUser;
use App\Models\User;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;
use Str;

class CreateUser implements CreatesUser
{
    public function __invoke(User $user, $roleSelected): User|ValidationException
    {
        $data = $user->toArray() + ['selected' => $roleSelected];

        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['nullable', 'sometimes', 'string', 'size:10'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,'.$user->id],
            'status' => ['required', new Enum(UserStatusEnum::class)],
            'selected' => ['required', 'array'],
        ];

        $data = Validator::validate($data, $rules, ['selected.required' => 'Access level is required.']);

        $roles = $data['selected'];
        unset($data['selected']);

        if(! $user->password) {
            $data = $data + $this->prepareUser();
        }

        //$role = $data['role_id']; //constant(RoleEnum::class.'::'.$data['role_id']);
        //unset($data['role_id'], $user->role_id);

        if($user->id) {
            $user->update($data);
            $user->syncRoles($roles);
        } else {
            $user = User::create($data);
            //$user->createDefaultSettings();
            $user->syncRoles($roles);

            event(new Registered($user));
        }


        $user->new = false;
        if($user->wasRecentlyCreated) {
            $user->fresh();
            $user->new = true;
        }

        return $user;
    }

    private function prepareUser()
    {
        $temp = Str::random(10);
        $data['password'] = Hash::make($temp);
        $data['temp'] = $temp;

        return $data;
        /*$user = User::create($data);
        $user->roles()->sync($request->input('roles'));
        event(new Registered($user));*/
    }
}




