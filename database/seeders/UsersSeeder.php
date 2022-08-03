<?php

namespace Database\Seeders;

use App\Enums\AssetTypeEnum;
use App\Enums\CurrencyEnum;
use App\Enums\Enums;
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
            'username' => 'administrator',
            'email' => 'ihab@abuafia.com',
            'mobile' => '00000000',
            'password' => bcrypt('password'),
        ]);

        $portfolio = $admin->portfolios()->create($this->defaultAccount());
        $portfolio->assets()->createMany($this->cashAsset($admin));

        $user = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'email' => 'john@doe.com',
            'mobile' => '0000000000',
            'password' => bcrypt('password'),
        ]);

        $portfolio = $user->portfolios()->create($this->defaultAccount());
        $portfolio->assets()->createMany($this->cashAsset($user));
    }

    private function defaultAccount()
    {
        return [
            'name' => 'Personal',
            'description' => 'Personal Portfolio',
        ];
    }

    private function cashAsset($user): array
    {
        return array([
            'user_id' => $user->id,
            'ticker' => 'CASH',
            'description' => 'Cash Account in CAD',
            'type' => Enums::Cash,
            'currency' => CurrencyEnum::CAD,
        ],
        [
            'user_id' => $user->id,
            'ticker' => 'CASH',
            'description' => 'Cash Account in USD',
            'type' => Enums::Cash,
            'currency' => CurrencyEnum::USD,
        ]);
    }
}
