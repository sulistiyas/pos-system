<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Furniture',
            'Clothing',
            'Books',
            'Toys',
            'Groceries',
        ];

        foreach ($categories as $name) {
            DB::table('categories')->insert([
                'category_name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
