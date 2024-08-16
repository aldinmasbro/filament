<?php

namespace Database\Seeders;

use App\Models\GuestBook;
use App\Models\Service;
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
            'name' => 'aldin',
            'email' => 'aldin09@gmail.com',
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
        //call database seeder
        $this->call([
            HeroSeeder::class,
            HeroSubTitleSeeder::class,
            ServiceSeeder::class,
            PortfolioCategorySeeder::class,
            PortfolioSeeder::class,
            ClientSeeder::class,
            TeamSeeder::class,
            TeamSocialSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
