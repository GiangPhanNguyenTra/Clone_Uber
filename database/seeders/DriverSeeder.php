<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use App\Enums\DriverStatus;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Driver::create([
            'name' => 'driver3',
            'email' => 'driver3@gmail.com',
            'avata' => null,
            'phone' => 1234567893,
            'verify' => 1,
            'gender' => 'nam',
            'password' => bcrypt('123'),
            'status_code' => DriverStatus::FREE,
            'status_description' => DriverStatus::getDescription(DriverStatus::FREE),
            'verify_token' => null,
        ])->assignRole('driver');
    }
}
