<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => fake()->name(),
            'email' => 'heshan.mu@fedexlk.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin#0613'),//password
        ]);
    }
}
