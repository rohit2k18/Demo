<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get all product IDs (assuming products table has data)
        $productIds = Product::all()->pluck('id')->toArray();

        // Generate 50 invoices
        foreach (range(1, 100) as $index) {
            DB::table('invoices')->insert([
                'invoice_no' => $faker->unique()->word . '-' . $faker->numberBetween(1000, 9999),
                'invoice_logo' => $faker->imageUrl(200, 200, 'business', true),
                'date' => $faker->date(),
                'customer' => $faker->name,
                'subtotal' => $faker->randomFloat(2, 50, 5000),
                'product_id' => $faker->randomElement($productIds), // Randomly select a product_id
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
