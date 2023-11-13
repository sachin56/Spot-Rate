<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            'description' => 'Admin',
        ]);
        DB::table('user_roles')->insert([
            'description' => 'AE',
        ]);
        DB::table('user_roles')->insert([
            'description' => 'Pricing',
        ]);
    }
}
