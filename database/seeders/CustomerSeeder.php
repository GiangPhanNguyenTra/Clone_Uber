<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'name' => 'customer4',
            'email' => 'customer4@gmail.com',
            'avata' => null,
            'phone' => '0886514684',
            'password' => bcrypt('123'),
            'address' => '123, phường Hưng Lợi, Quận Ninh Kiều, Thành Phố Cần Thơ',
            'gender' => 'nam',
            'verify' => true,
            'is_on_ride' => 0,
        ])->assignRole('customer');
    }
}
