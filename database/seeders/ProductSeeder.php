<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [];

        for ($i = 1; $i <= 100; $i++) {
            $products[] = [
                'name' => 'Product ' . $i,
                'description' => Str::random(50),
                'stock' => rand(1, 100),
                'price' => rand(100, 1000) / 10, // Prices between 10.0 and 100.0
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('products')->insert($products);
    }
}
