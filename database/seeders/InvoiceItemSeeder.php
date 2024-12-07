<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceItem;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 100 invoices with associated items
        foreach (range(1, 100) as $index) {
            // Create an invoice (No product_id here)
            $invoice = Invoice::create([
                'invoice_no' => $faker->unique()->word . '-' . $faker->numberBetween(1000, 9999),
                'invoice_logo' => $faker->imageUrl(200, 200, 'business', true),
                'date' => $faker->date(),
                'customer' => $faker->name,
                'subtotal' => $faker->randomFloat(2, 50, 5000), // Subtotal of the invoice
            ]);

            // Generate a random number of invoice items (between 1 and 5 items per invoice)
            $numberOfItems = $faker->numberBetween(1, 5);

            foreach (range(1, $numberOfItems) as $itemIndex) {
                // Get a random product from the Product table
                $product = Product::inRandomOrder()->first();

                // Calculate item total price
                $quantity = $faker->numberBetween(1, 10);
                $price = $product->price;
                $totalPrice = $quantity * $price;

                // Create an invoice item (make sure we're adding to the invoice_items table)
                InvoiceItem::create([
                    'invoice_id' => $invoice->id, // associate with the created invoice
                    'product_id' => $product->id, // associate with a random product
                    'quantity' => $quantity,
                    'price' => $price,
                    'total_price' => $totalPrice,
                ]);
            }
        }
    }
}
