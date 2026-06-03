<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * ProductSeeder
 * Seeder untuk membuat data produk sample
 */
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
        
            [
                'category_id' => 1,
                'name' => 'Long Sleeve T-Shirt STS',
                'price' => 85000,
                'weight' => 500,
                'stock' => 10,
                'description' => 'T-Shirt lengan panjang berkualitas tinggi',
                'image' => 'products\baju\baju1.png',
            ],
        
            [
                'category_id' => 1,
                'name' => 'Crew Neck T-Shirt',
                'price' => 100000,
                'weight' => 500,
                'stock' => 10,
                'description' => 'T-Shirt crew neck berkualitas tinggi',
                'image' => 'products\baju\baju2.png',
            ],

            [
                'category_id' => 1,
                'name' => 'T-Shirt Lengan Pendek',
                'price' => 150000,
                'weight' => 500,
                'stock' => 10,
                'description' => 'T-Shirt lengan pendek berkualitas tinggi',
                'image' => 'products\baju\baju3.png',
            ],

            [
                'category_id' => 1,
                'name' => 'T-Shirt Kece',
                'price' => 135000,
                'weight' => 500,
                'stock' => 10,
                'description' => 'T-Shirt lengan pendek berkualitas tinggi',
                'image' => 'products\baju\baju4.png',
            ],

            [
                'category_id' => 1,
                'name' => 'Baju Kemeja Lengan Pendek',
                'price' => 135000,
                'weight' => 500,
                'stock' => 10,
                'description' => 'Baju kemeja lengan pendek berkualitas tinggi',
                'image' => 'products\baju\baju5.png',
            ],
        
            [
                'category_id' => 2,
                'name' => 'Jeans Washed Denim Panjang',
                'price' => 320000,
                'weight' => 800,
                'stock' => 10,
                'description' => 'Jeans washed denim panjang berkualitas tinggi',
                'image' => 'products\celana\celana1.png',
            ],

            [
                'category_id' => 2,
                'name' => 'Jeans Hitam Panjang Polos',
                'price' => 95000,
                'weight' => 800,
                'stock' => 10,
                'description' => 'Jeans hitam panjang polos berkualitas tinggi',
                'image' => 'products\celana\celana2.png',
            ],

            [
                'category_id' => 2,
                'name' => 'Jeans Denim Hitam',
                'price' => 185000,
                'weight' => 800,
                'stock' => 10,
                'description' => 'Jeans denim hitam berkualitas tinggi',
                'image' => 'products\celana\celana4.png',
            ],

            [
                'category_id' => 2,
                'name' => 'Jeans Denim Biru Muda',
                'price' => 250000,
                'weight' => 800,
                'stock' => 10,
                'description' => 'Jeans denim biru muda berkualitas tinggi',
                'image' => 'products\celana\celana5.png',
            ],

            [
                'category_id' => 3,
                'name' => 'Topi STS',
                'price' => 158000,
                'weight' => 200,
                'stock' => 10,
                'description' => 'Topi nyaman dan stylish',
                'image' => 'products\topi\topi1.png',
            ],

            [
                'category_id' => 3,
                'name' => 'Topi Putih Keren',
                'price' => 165000,
                'weight' => 200,
                'stock' => 10,
                'description' => 'Topi nyaman dan stylish',
                'image' => 'products\topi\topi2.png',
            ],

            [
                'category_id' => 3,
                'name' => 'Topi Denim Hitam',
                'price' => 90000,
                'weight' => 200,
                'stock' => 10,
                'description' => 'Topi nyaman dan stylish',
                'image' => 'products\topi\topi3.png',
            ],

            [
                'category_id' => 3,
                'name' => 'Topi Hitam Polos',
                'price' => 90000,
                'weight' => 200,
                'stock' => 10,
                'description' => 'Topi nyaman dan stylish',
                'image' => 'products\topi\topi4.png',
            ],
            
            [
                'category_id' => 4,
                'name' => 'Hoodie STS',
                'price' => 250000,
                'weight' => 1000,
                'stock' => 10,
                'description' => 'Hoodie nyaman dan stylish',
                'image' => 'products\hodie\hodie1.png',
            ],
            
            [
                'category_id' => 4,
                'name' => 'Hoodie Hitam Polos',
                'price' => 220000,
                'weight' => 1000,
                'stock' => 10,
                'description' => 'Hoodie nyaman dan stylish',
                'image' => 'products\hodie\hodie2.png',
            ],
            
            [
                'category_id' => 4,
                'name' => 'Hoodie Crop Top Hitam',
                'price' => 280000,
                'weight' => 1000,
                'stock' => 10,
                'description' => 'Hoodie nyaman dan stylish',
                'image' => 'products\hodie\hodie3.png',
            ],
            
            [
                'category_id' => 4,
                'name' => 'Hoodie Double Zipper',
                'price' => 200000,
                'weight' => 1000,
                'stock' => 10,
                'description' => 'Hoodie nyaman dan stylish',
                'image' => 'products\hodie\hodie4.png',
            ],

        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('✓ ' . count($products) . ' products created successfully.');
    }
}
