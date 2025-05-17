<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttachementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attachement_types')->insert([
            [
                'type' => 'Un-resolved',
                'status' => 1,
                'archive' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'type' => 'Resolved',
                'status' => 1,
                'archive' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
