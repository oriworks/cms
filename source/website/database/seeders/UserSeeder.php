<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        $superAdmin = \App\Models\Role::where('name', 'super-admin')->first();

        // Users
        \App\Models\User::factory()->create([
            'id' => '9a82111c-b8e3-4794-9b06-5c6cd5a91a79',
            'name' => 'Joel Oliveira',
            'email' => 'joeloliveira@oriworks.com',
            'password' => bcrypt('qwerty123')
        ])->assignRole($superAdmin);

        \App\Models\User::factory()->create([
            'id' => '5a54456c-278c-4462-9d5c-42c3e5d523b6',
            'name' => 'Default User',
            'email' => 'default@oriworks.com',
            'password' => bcrypt('qwerty123')
        ]);
    }
}
