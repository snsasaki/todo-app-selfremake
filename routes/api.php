<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoController;
use App\Http\Middleware\TokenAuth;
use Illuminate\Support\Facades\Route;

// 接続確認用GET
Route::get('/', function () {
  return 'Connection Successful.';
});
Route::middleware([TokenAuth::class])->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Todoの管理
Route::middleware([TokenAuth::class])->group(function () {
  Route::put('/todo/create', [TodoController::class, 'create']);
  // Todo 取得
  Route::get('/todo/list', [TodoController::class, 'list']);
  // Todo 更新
  Route::put('/todo/update', [TodoController::class, 'update']);
});
