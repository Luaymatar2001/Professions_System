<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\specialties;
use Illuminate\Database\Seeder;
use Database\Seeders\ProfessionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AboutSeeder::class);
        $this->call(SpecialtiesSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(ProfessionSeeder::class);
    }
}
