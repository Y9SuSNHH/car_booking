<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(500)->create();
        Car::factory(500)->create();
        $this->call(BillSeeder::class);
//         Bill::factory(500)->create();
    }
}
