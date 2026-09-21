<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => 'password']
        );

        // Disabled so CountySeeder/CitySeeder can truncate+reinsert safely
        // regardless of whether cities already reference existing counties.
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call([
            CountySeeder::class,
            CitySeeder::class,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
