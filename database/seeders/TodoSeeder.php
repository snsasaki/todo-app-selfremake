<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TODO: factoryを使ってまとめて書く
        Todo::create([
            'title' => 'PHP学習',
            'body' => 'phpの勉強を1時間します。',
            'is_done' => false,
            'user_id' => 1,
        ]);
        Todo::create([
            'title' => 'PHP学習',
            'body' => 'phpの勉強を1時間します。',
            'is_done' => false,
            'user_id' => 2,
        ]);
        Todo::create([
            'title' => 'SQL学習',
            'body' => 'sqlの勉強を1時間します。',
            'is_done' => false,
            'user_id' => 2,
        ]);
        Todo::create([
            'title' => 'SQL学習',
            'body' => 'sqlの勉強を1時間します。',
            'is_done' => false,
            'user_id' => 3,
        ]);
        Todo::create([
            'title' => 'オブジェクト指向学習',
            'body' => 'オブジェクト指向の勉強を1時間します。',
            'is_done' => false,
            'user_id' => 1,
        ]);
        Todo::create([
            'title' => 'オブジェクト指向学習',
            'body' => 'オブジェクト指向の勉強を1時間します。',
            'is_done' => false,
            'user_id' => 3,
        ]);
    }
}
