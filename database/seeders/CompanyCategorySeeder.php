<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_categories')->insert([
            [
                'name' => 'Real Estate Maintenance',
                'status' => 1,
                'archive' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Utility Services (Water & Electricity)',
                'status' => 1,
                'archive' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Telecommunications Infrastructure',
                'status' => 1,
                'archive' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Roads & Transportation',
                'status' => 1,
                'archive' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
