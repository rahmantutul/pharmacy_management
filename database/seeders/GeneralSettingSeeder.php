<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('general_settings')->insert([
            'appname' => 'Pharmacy Management',
            'currency' => 'Taka',
            'prefix' => '',
            'email' => 'rahmantutul50@gmail.com',
            'phone' => '01881053602',
            'address' => '133/4 East rampura Dhaka, 1219',
            'lowstockalert' => 10,
            'expiryalert' => 10,
            'timezone' => 'UTC',
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
        ]);
    }
}
