<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
<<<<<<< HEAD
=======
use Database\Seeders\PostSeeder;
>>>>>>> c401750 (Initial commit for assignment-3)

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // \App\Models\User::factory(10)->create();
=======

        $this->call([
            // UserSeeder::class,
            PostSeeder::class,
            // CommentSeeder::class,
        ]);


        // \App\Models\User::factory(2)->create();
>>>>>>> c401750 (Initial commit for assignment-3)

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
