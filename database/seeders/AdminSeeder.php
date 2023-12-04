<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
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
            'username' => 'admin@admin.com',
            'password' => bcrypt('123'),
            'verify' => true,
        ])->assignRole('admin');
    }
}
