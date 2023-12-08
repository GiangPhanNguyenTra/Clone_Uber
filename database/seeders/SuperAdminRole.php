<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class SuperAdminRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Phan Tấn Duy',
            'username' => 'super-admin@admin.com',
            'password' => bcrypt('123'),
            'verify' => true,
        ])->assignRole('super-admin');
    }
}
