<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'customer_name' => 'John Doe',
                'customer_email' => 'john@example.com',
                'customer_phone' => '081234567890',
                'customer_address' => 'Jl. Merdeka No. 1, Jakarta',
            ],
            [
                'customer_name' => 'Jane Smith',
                'customer_email' => 'jane@example.com',
                'customer_phone' => '081298765432',
                'customer_address' => 'Jl. Sudirman No. 2, Bandung',
            ],
            [
                'customer_name' => 'Michael Tan',
                'customer_email' => 'michael@example.com',
                'customer_phone' => '082112345678',
                'customer_address' => 'Jl. Asia Afrika No. 3, Surabaya',
            ],
            [
                'customer_name' => 'Siti Aminah',
                'customer_email' => 'siti@example.com',
                'customer_phone' => '083812345678',
                'customer_address' => 'Jl. Diponegoro No. 4, Yogyakarta',
            ],
            [
                'customer_name' => 'Budi Santoso',
                'customer_email' => 'budi@example.com',
                'customer_phone' => '085612345678',
                'customer_address' => 'Jl. Gajah Mada No. 5, Semarang',
            ],
        ];

        foreach ($customers as $customer) {
            DB::table('customers')->insert([
                ...$customer,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
