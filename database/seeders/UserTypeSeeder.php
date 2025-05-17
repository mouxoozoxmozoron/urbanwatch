<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('user_types')->insert([
            [
                'name' => 'Admin',
                'status' => 1,
                'archive' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Consultant',
                'status' => 1,
                'archive' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Volunteer',
                'status' => 1,
                'archive' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Default',
                'status' => 1,
                'archive' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
