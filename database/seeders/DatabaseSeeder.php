<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // insert record for database seeders
        $data = array(
            [
                'name' => 'bahri',
                'email' => 'bahrysaipul266@gmail.com',
                'password' => Hash::make('superadmin098'),
                'role' => 'super_admin'
            ],
            [
                'name' => 'admin',
                'email' => 'sbahry063@gmail.com',
                'password' => Hash::make('admin098'),
                'role' => 'admin'
            ]
        );
        User::insert($data);
    }
}
