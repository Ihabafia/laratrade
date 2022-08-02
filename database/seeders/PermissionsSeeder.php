<?php

namespace Database\Seeders;

use App\Enums\PermissionEnums;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::findByName(RoleEnum::Admin->value);
        $user = Role::findByName(RoleEnum::User->value);

        foreach (PermissionEnums::cases() as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin->givePermissionTo([
            PermissionEnums::ManageUsers->value,
            PermissionEnums::ManagePortfolios->value,
            PermissionEnums::ManagePortfolio->value,
            PermissionEnums::ManageStocks->value,
        ]);

        $user->givePermissionTo([
            PermissionEnums::ManagePortfolio->value,
            PermissionEnums::ManageStocks->value,
        ]);
    }
}
