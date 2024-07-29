<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'I Phone Pro 13',
                'price' => 299,
                'description' => 'Description for I Phone Pro 13',
            ],
            [
                'name' => 'Whirlpool Freeze',
                'price' => 199.50,
                'description' => 'Description for Whirlpool Freeze',
            ],
            [
                'name' => 'Acer Laptop',
                'price' => 249,
                'description' => 'Description for Acer Laptop',
            ],
            [
                'name' => 'LG Washing Machine',
                'price' => 229.8,
                'description' => 'Description for LG Washing Machine',
            ],
            [
                'name' => 'Adidas Sprt Shoes',
                'price' => 49.60,
                'description' => 'Description for Adidas Sprt Shoes',
            ],
        ]);
    }
}
