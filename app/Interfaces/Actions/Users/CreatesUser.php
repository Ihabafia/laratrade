<?php

namespace App\Interfaces\Actions\Users;

use App\Models\User;
use Illuminate\Validation\ValidationException;

interface CreatesUser
{
    public function __invoke(User $user, array $roleSelected): User|ValidationException;
}
