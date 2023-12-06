<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mohammad Ryan Chahour',
            'email' => 'mohammadryanchahour01@gmail.com',
            'password' => bcrypt('Sherii1122'),
            'isAdmin' => true,
        ]);
    }
}
