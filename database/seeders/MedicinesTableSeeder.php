<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Leaf;
use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $leafId = Leaf::pluck('id')->toArray();
        $categoryId = Category::pluck('id')->toArray();
        $vendorId = Vendor::pluck('id')->toArray();
        $supplierId = Supplier::pluck('id')->toArray();

        foreach (range(1, 1000) as $index) {
            // Generate dummy data
            $medicine = new Medicine();
            $medicine->qrcode = $faker->word;
            $medicine->hnscode = $faker->numberBetween(1000000, 9999999);
            $medicine->name = $faker->word;
            $medicine->strength = $faker->word;
            $medicine->genericname = $faker->word;
            $medicine->shelf = $faker->word;
            $medicine->desc = $faker->word;
            $medicine->igta = $faker->numberBetween(1, 500);
            $medicine->status = 1;
            $medicine->leafId = $faker->randomElement($leafId);
            $medicine->categoryId = $faker->randomElement($categoryId);
            $medicine->vendorId = $faker->randomElement($vendorId);
            $medicine->supplierId = $faker->randomElement($supplierId);
            $medicine->image = 'deafult.png';
            $medicine->save();
        }
    }
}
