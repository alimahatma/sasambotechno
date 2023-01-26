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
                'name' => 'super admin',
                'email' => 'sasambotechno@gmail.com',
                'password' => Hash::make('superadmin098'),
                'role' => 'superadmin'
            ],
            [
                'name' => 'administrator',
                'email' => 'bahrysaipul266@gmail.com',
                'password' => Hash::make('kasir098'),
                'role' => 'kasir'
            ]
        );
        User::insert($data);
    }
}
