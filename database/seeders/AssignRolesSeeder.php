<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webmaster1 = User::find(1);
        $webmaster1->assignRole(RoleEnum::Admin->value);
        $webmaster1->assignRole(RoleEnum::User->value);
        $webmaster2 = User::find(2);
        $webmaster2->assignRole(RoleEnum::User->value);
    }
}
