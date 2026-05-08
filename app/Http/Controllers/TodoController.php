<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TodoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{

    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function create(Request $request): JsonResponse
    {

        // TODO: Refactorできそう
        $token = $request->header('X-API-TOKEN');

        $request->validate([
            'title' => 'required',
        ]);

        $userId = User::where('api_token', $token)->first()->id;

        $todo = $request->all();
        $todo['user_id'] = $userId;

        $this->todoService->create($todo);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully created Todo.',
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $userId,
        ]);
    }
}
