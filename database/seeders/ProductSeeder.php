<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Create sample products
        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'description' => 'Description for Product 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description for Product 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more products as needed...
        ]);
    }
}
