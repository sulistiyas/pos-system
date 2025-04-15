<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productData = [
            1 => [ // Electronics
                ['Smartphone XYZ', 3500000, 100],
                ['Laptop Pro Max', 12500000, 40],
                ['Wireless Earbuds', 850000, 120],
                ['Smartwatch Series 5', 2750000, 60],
            ],
            2 => [ // Furniture
                ['Office Chair', 750000, 50],
                ['Wooden Desk', 1350000, 30],
                ['Bookshelf Minimalist', 650000, 20],
                ['Dining Table Set', 2500000, 15],
            ],
            3 => [ // Clothing
                ['Jeans Denim', 200000, 200],
                ['T-Shirt Cotton', 95000, 300],
                ['Jacket Bomber', 325000, 80],
                ['Sweater Hoodie', 175000, 150],
            ],
            4 => [ // Books
                ['Novel: Laskar Pelangi', 95000, 150],
                ['Komik Naruto Vol. 1', 40000, 200],
                ['Buku Masak Nusantara', 85000, 75],
                ['Ensiklopedia Sains', 125000, 60],
            ],
            5 => [ // Toys
                ['LEGO Classic Set', 500000, 80],
                ['Remote Car RC', 320000, 90],
                ['Doll Princess Elsa', 150000, 110],
                ['Puzzle 1000 Pieces', 100000, 70],
            ],
            6 => [ // Groceries
                ['Instant Noodles Pack', 30000, 500],
                ['Beras 5Kg', 65000, 250],
                ['Minyak Goreng 2L', 38000, 300],
                ['Susu Bubuk 400g', 42000, 180],
            ],
        ];

        foreach ($productData as $categoryId => $products) {
            foreach ($products as [$name, $price, $stock]) {
                DB::table('products')->insert([
                    'product_name' => $name,
                    'product_price' => $price,
                    'product_stock' => $stock,
                    'id_category' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
