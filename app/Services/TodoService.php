<?php

namespace App\Services;

use App\Models\Todo;

class TodoService
{
  public function create(array $data): Todo
  {
    return Todo::create([
      'title' => $data['title'],
      'body' => $data['body'] ?? null,
      'user_id' => $data['user_id'],
      'is_done' => false,
    ]);
  }
  public function getTodoList(int $userId)
  {
    return Todo::where('user_id', $userId)->get();
  }
}
