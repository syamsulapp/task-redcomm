<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'redcomm',
            'name' => 'redcomm users',
            'email' => 'redcomm@gmail.com',
            'password' => Hash::make('redcommweb'),
            'role_id' => 1,
        ]);
        DB::table('users')->insert([
            'username' => 'redcommadmin',
            'name' => 'redcomm admin',
            'email' => 'redcomm_admin@gmail.com',
            'password' => Hash::make('redcommadmin'),
            'role_id' => 2,
        ]);
    }
}
