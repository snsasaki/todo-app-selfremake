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
}
