<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create two users
        User::insert([
            [
                'name' => 'User1',
                'email' => 'user1@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'User2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password456'),
            ]
        ]);
    }
}
