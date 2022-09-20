<?php

namespace Database\Factories;

use App\Enums\CarStatusEnum;
use App\Enums\CarTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'             => $this->faker->company,
            'image'            => $this->faker->imageUrl(),
            'city'             => $this->faker->city,
            'district'         => $this->faker->streetName,
            'type'             => $this->faker->randomElement(CarTypeEnum::getValues()),
            'slot'             => $this->faker->randomElement(array(4, 5, 7)),
            'transmission'     => $this->faker->boolean(),
            'fuel'             => $this->faker->boolean(),
            'fuel_comsumpiton' => $this->faker->numberBetween(50, 200),
            'description'      => $this->faker->realText(200),
            'price_1_day'      => $this->faker->numberBetween(100000, 5000000),
            'price_insure'     => $this->faker->numberBetween(50000, 500000),
            'price_service'    => $this->faker->numberBetween(50000, 500000),
            'status'           => $this->faker->randomElement(CarStatusEnum::getValues()),
        ];
    }
}
