<?php

namespace Database\Factories;

use App\Enums\Bill\BillStatusEnum;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id"       => User::query()->inRandomOrder()->value('id'),
            "car_id"        => Car::query()->inRandomOrder()->value('id'),
            "date_start"    => $this->faker->date(),
            "date_end"      => $this->faker->date(),
            "total_price"   => $this->faker->numberBetween(500000,20000000),
            "status"        => $this->faker->randomElement(BillStatusEnum::getValues()),
        ];
    }
}
