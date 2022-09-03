<?php

namespace Database\Seeders;

use App\Enums\Bill\BillStatusEnum;
use App\Models\Bill;
use App\Models\Car;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr   = [];
        $n     = 5000;
        $faker = Factory::create();
        $users = User::query()->pluck('id')->toArray();
        $cars  = Car::query()->pluck('id')->toArray();
        for ($i = 0; $i <= $n; $i++) {
            $arr[] = [
                "user_id"     => $faker->randomElement($users),
                "staff_start" => $faker->randomElement($users),
                "staff_end"   => $faker->randomElement($users),
                "car_id"      => $faker->randomElement($cars),
                "date_start"  => $faker->date(),
                "date_end"    => $faker->date(),
                "total_price" => $faker->numberBetween(500000, 10000000),
                "status"      => $faker->randomElement(BillStatusEnum::getValues()),
            ];
            if ($i % 1000 === 0) {
                Bill::insert($arr);
                $arr = [];
            }
        }
    }
}
