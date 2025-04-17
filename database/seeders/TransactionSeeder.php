<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactionId = 1;
        $detailId = 1;

        for ($i = 0; $i < 20; $i++) {
            // Generate a random date within the past year
            $date = Carbon::now()->subDays(rand(0, 365));
            $customerId = rand(1, 5);
            $transactionTotal = 0;

            // Insert transaction with integer ID
            DB::table('transactions')->insert([
                'id_transaction' => $transactionId,
                'transaction_date' => $date->day,
                'transaction_month' => $date->month,
                'transaction_year' => $date->year,
                'transaction_total' => 0, // will be updated later
                'id_customer' => $customerId,
            ]);

            // Insert 1–5 detail transactions
            $numDetails = rand(1, 5);

            for ($j = 0; $j < $numDetails; $j++) {
                $productId = rand(1, 6); // Assuming product IDs 1–20
                $qty = rand(1, 100);
                $price = rand(1000, 100000);
                $subtotal = $qty * $price;
                $transactionTotal += $subtotal;

                DB::table('detail_transactions')->insert([
                    'id_detail_transaction' => $detailId,
                    'id_transaction' => $transactionId,
                    'id_product' => $productId,
                    'detail_transaction_qty' => $qty,
                    'detail_transaction_subtotal' => $subtotal,
                ]);

                $detailId++;
            }

            // Update total in the transaction
            DB::table('transactions')
                ->where('id_transaction', $transactionId)
                ->update(['transaction_total' => $transactionTotal]);

            $transactionId++;
        }
    }
}
