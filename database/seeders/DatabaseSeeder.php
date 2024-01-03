<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        \App\Models\User::create([
            'username' => 'user1',
            'password' => bcrypt('user1pw'),
        ]);

        \App\Models\User::create([
            'username' => 'user2',
            'password' => bcrypt('user2pw'),
        ]);
        
        \App\Models\Player::create([
            'posisi' => 'CF',
            'nama' => 'Lionel Messi',
            'nomor_punggung' => 10,
            'createdBy' => 1,
        ]);
        \App\Models\Player::create([
            'posisi' => 'CF',
            'nama' => 'Cristiano Ronaldo',
            'nomor_punggung' => 7,
            'createdBy' => 2,
        ]);
    }
}

