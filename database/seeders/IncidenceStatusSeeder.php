<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidenceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('incidence_statuses')->insert([
            [
                'name' => 'Pending',
                'status' => 1,
                'archive' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'In Progress',
                'status' => 1,
                'archive' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Resolved',
                'status' => 1,
                'archive' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Archived',
                'status' => 0,
                'archive' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
