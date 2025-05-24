<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'Dar Real Estate Services',
                'description' => 'Company handling residential and commercial real estate maintenance.',
                'category' => 1, // Assuming 1 = Real Estate Maintenance
                'status' => 1,
                'archive' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'admin_id' => 1,
            ],
            [
                'name' => 'WaterFix Tanzania',
                'description' => 'Specializes in fixing and maintaining water pipeline systems.',
                'category' => 2, // Utility Services
                'status' => 1,
                'archive' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'admin_id' => 1,
            ],
            [
                'name' => 'FiberTrack Limited',
                'description' => 'Maintains fiber optic and telecom infrastructures.',
                'category' => 3, // Telecom
                'status' => 1,
                'archive' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'admin_id' => 1,
            ],
            [
                'name' => 'InfraRoad Builders',
                'description' => 'Focuses on road and bridge maintenance projects.',
                'category' => 4, // Roads & Transportation
                'status' => 1,
                'archive' => 0,
                'created_at' => now(),
                'updated_at' => now(),
                'admin_id' => 1,
            ],
        ]);
    }
}
