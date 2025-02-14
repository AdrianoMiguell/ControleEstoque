<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'anderson',
                'email' => 'anderson@email.com',
                'type' => '0',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'type' => '1',
                'password' => Hash::make('12345678')
            ]
        ]);
    }
}
