<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name'        => 'Cappuccino',
                'description' => 'Rich espresso with creamy milk foam',
                'price'       => 28000,
                'rating'      => 4.8,
                'is_available'=> true,
            ],
            [
                'name'        => 'Gula Aren',
                'description' => 'Palm sugar sweetness with milk',
                'price'       => 25000,
                'rating'      => 4.6,
                'is_available'=> true,
            ],
            [
                'name'        => 'Latte',
                'description' => 'Smooth and creamy latte',
                'price'       => 30000,
                'rating'      => 4.7,
                'is_available'=> true,
            ],
            [
                'name'        => 'Ramell Latte',
                'description' => 'Caramel infused latte',
                'price'       => 32000,
                'rating'      => 4.9,
                'is_available'=> true,
            ],
            [
                'name'        => 'Coconut Cappuccino',
                'description' => 'With creamy coconut milk',
                'price'       => 33000,
                'rating'      => 4.8,
                'is_available'=> true,
            ],
            [
                'name'        => 'Iced Americano',
                'description' => 'Refreshing cold brew',
                'price'       => 22000,
                'rating'      => 4.4,
                'is_available'=> true,
            ],
            [
                'name'        => 'Matcha Latte',
                'description' => 'Premium Japanese matcha with steamed milk',
                'price'       => 32000,
                'rating'      => 4.7,
                'is_available'=> true,
            ],
            [
                'name'        => 'Espresso',
                'description' => 'Pure bold espresso shot',
                'price'       => 20000,
                'rating'      => 4.5,
                'is_available'=> true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}