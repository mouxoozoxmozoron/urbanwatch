<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(IncidenceStatusSeeder::class);
        $this->call(AttachementTypeSeeder::class);
        $this->call([
            UserTypeSeeder::class,
        ]);
        $this->call([
            UserSeeder::class,
        ]);


    }
}

// php artisan db:seed --class=IncidenceStatusSeeder
//php artisan db:seed --class=AttachementTypeSeeder
//php artisan db:seed --class=UserTypeSeeder
//php artisan db:seed --class=UserSeeder

