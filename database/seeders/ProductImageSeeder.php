<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        // Create sample product images
        DB::table('product_images')->insert([
            [
                'product_id' => 1, // Associate with Product ID 1
                'image_url' => 'https://unsplash.com/photos/bag-sitting-on-a-dock-LX1qE-yF_Zs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1, // Associate with Product ID 1
                'image_url' => 'https://unsplash.com/photos/beige-eco-bag-1Pgq9ZpIatI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more images as needed...
        ]);
    }
}
