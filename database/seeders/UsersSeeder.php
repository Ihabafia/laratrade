<?php

namespace Database\Seeders;

use App\Enums\AssetTypeEnum;
use App\Enums\CurrencyEnum;
use App\Enums\TimeZone;
use App\Enums\TransactionEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'first_name' => 'Ihab',
            'last_name' => 'Abou Afia',
            'username' => 'ihabafia',
            'email' => 'ihab@abuafia.com',
            'mobile' => '4165803210',
            'password' => bcrypt('password'),
        ]);

        $admin->accounts()->create($this->defaultAccount());
        $admin->assets()->createMany($this->cashAsset());

        $user = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'email' => 'john@doe.com',
            'mobile' => '4165803210',
            'password' => bcrypt('password'),
        ]);

        $user->accounts()->create($this->defaultAccount());
        $user->assets()->createMany($this->cashAsset());
    }

    private function defaultAccount()
    {
        return [
            'name' => 'Personal',
            'cash' => [
                'CAD' => 0,
                'USD' => 0,
            ]
        ];
    }

    private function cashAsset(): array
    {
        return array([
            'ticker' => 'CASH',
            'description' => 'Cash Deposits / Withdrawals CAD',
            'type' => AssetTypeEnum::Cash,
            'currency' => CurrencyEnum::CAD,
        ],
        [
            'ticker' => 'CASH',
            'description' => 'Cash Deposits / Withdrawals USD',
            'type' => AssetTypeEnum::Cash,
            'currency' => CurrencyEnum::USD,
        ]);
    }
}
