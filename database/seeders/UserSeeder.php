<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: factoryを使ってまとめて書く
        User::create([
            'name' => '研修ユーザー2',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => '研修ユーザー3',
            'email' => 'user3@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
