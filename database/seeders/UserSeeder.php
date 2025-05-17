<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Yoyo',
            'last_name' => 'Admin',
            'phone' => '0700000000',
            'email' => 'yoyo@aftarkeianet.com',
            'email_verified_at' => Carbon::now(),
            'user_type_id' => 1,
            'password' => Hash::make('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
