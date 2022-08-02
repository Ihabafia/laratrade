<?php

namespace App\Services;

use App\Enums\FrequencyEnum;
use Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationsVariables extends Factory
{

    public function newUserActivationNotification(): array
    {
        return [
            'email' => [
                'first_name' => [
                    'mask' => '{@first_name@}',
                    'type' => 'string',
                    'dummy' => $this->faker->firstName(),
                ],
                'link' => [
                    'mask' => '{_{@link@},success,Activate & Login_}',
                    'type' => 'button',
                    'dummy' => '#',
                ],
            ],
        ];
    }

    public function __call($command, $args)
    {
        if(method_exists($this, $method = Str::camel($command))) {
            return $this->{$method}();
        }

        return [];
    }

    public function definition()
    {
        // TODO: Implement definition() method.
    }
}
