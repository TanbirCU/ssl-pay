<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Product 1',
                'image' => '1.jpg',
                'product_id' => '#001',
                'price' => 399,
                'original_price' => 700,
                'discount_percent' => '-43%',
            ],
            [
                'name' => 'Product 2',
                'image' => '2.jpg',
                'product_id' => '#002',
                'price' => 299,
                'original_price' => 500,
                'discount_percent' => '-40%',
            ],
            [
                'name' => 'Product 3',
                'image' => '3.jpg',
                'product_id' => '#003',
                'price' => 499,
                'original_price' => 800,
                'discount_percent' => '-38%',
            ],
            [
                'name' => 'Product 4',
                'image' => '4.jpg',
                'product_id' => '#004',
                'price' => 599,
                'original_price' => 1000,
                'discount_percent' => '-40%',
            ],
            [
                'name' => 'Product 5',
                'image' => '5.jpg',
                'product_id' => '#005',
                'price' => 799,
                'original_price' => 1200,
                'discount_percent' => '-33%',
            ],
            [
                'name' => 'Product 6',
                'image' => '6.jpg',
                'product_id' => '#006',
                'price' => 199,
                'original_price' => 400,
                'discount_percent' => '-50%',
            ],
            [
                'name' => 'Product 7',
                'image' => '7.jpg',
                'product_id' => '#007',
                'price' => 899,
                'original_price' => 1500,
                'discount_percent' => '-40%',
            ],
            [
                'name' => 'Product 8',
                'image' => '8.jpg',
                'product_id' => '#008',
                'price' => 999,
                'original_price' => 1700,
                'discount_percent' => '-41%',
            ],
            [
                'name' => 'Product 9',
                'image' => '9.jpg',
                'product_id' => '#009',
                'price' => 1099,
                'original_price' => 2000,
                'discount_percent' => '-45%',
            ],
            [
                'name' => 'Product 10',
                'image' => '10.jpg',
                'product_id' => '#010',
                'price' => 1499,
                'original_price' => 2500,
                'discount_percent' => '-40%',
            ],
        ];

        DB::table('products')->insert($products);
    }
}
