<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        DB::table('users')->insert([
            'nom' => 'admin',
            'prenom' => 'admin',
            'password' => Hash::make('password'),
            'email' => 'admin@gmail.com',
            'phone' => '55685565',
            'is_active' => '1',
            'is_admin' => '1',
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'nom' => 'user',
            'prenom' => 'user',
            'password' => Hash::make('password'),
            'email' => 'user@gmail.com',
            'phone' => '55685565',
            'is_active' => '1',
            'is_admin' => '0',
            'role' => 'user',
        ]);
    }
}
