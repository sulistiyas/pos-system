<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin'),
                'roles' => 'admin',
            ],
            [
                'name' => 'Cashier One',
                'email' => 'cashier1@example.com',
                'roles' => 'cashier',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Cashier Two',
                'email' => 'cashier2@example.com',
                'roles' => 'cashier',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Cashier Three',
                'email' => 'cashier3@example.com',
                'roles' => 'cashier',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                ...$user,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
