<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $dosen = User::factory()->create([
            'name' => 'Dosen PBKK',
            'email' => 'dosenpbkk@its.ac.id',
            'password' => Hash::make('password'), // hashed cast makes this idempotent
        ]);

        // A few ready-to-present projects for the demo account.
        Project::factory()
            ->count(3)
            ->for($dosen)
            ->create([
                'judul' => 'Agentic AI Portfolio Assistant for ITS Students',
            ]);

        // 15 random students, each with 2 dummy projects.
        User::factory()
            ->count(15)
            ->has(Project::factory()->count(2))
            ->create();
    }
}
