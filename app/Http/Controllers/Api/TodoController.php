<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TodoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        // TODO: Tokenからidを抽出する処理を汎用化する
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

    public function list(Request $request): JsonResponse
    {
        $token = $request->header('X-API-TOKEN');

        $userId = User::where('api_token', $token)->first()->id;

        $list = $this->todoService->getTodoList($userId);

        return response()->json([$list]);
    }
    public function update(Request $request): JsonResponse
    {

        $token = $request->header('X-API-TOKEN');

        $userId = User::where('api_token', $token)->first()->id;

        $validated = $request->validate([
            'id' => 'required',
            'title' => 'required',
            'body' => 'nullable',
            'is_done' => 'nullable',
            'boolean',
            'user_id' => 'required',
        ]);

        if ($validated['user_id'] == $userId) {

            $this->todoService->update($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully updated Todo.',
                'title' => $request->title,
                'body' => $request->body,
                'is_done' => $request->is_done,
                'user_id' => $request->user_id,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => ' 権限がありません。',
            ], 403);
        }
    }
}
