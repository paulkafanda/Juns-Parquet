<?php

namespace Database\Seeders;

use App\Enums\UserRole;
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

        foreach (UserRole::cases() as $role) {
            User::factory()->create([
                'name' => ucfirst($role->value),
                'email' => $role->value . '@parquet.gouv.cd',
                'role' => $role->value, // Assuming you have a 'role' column in your users table
            ]);
        }
    }
}
