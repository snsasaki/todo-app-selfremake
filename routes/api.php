<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// 接続確認用GET
Route::get('/', function () {
  return 'Connection Successful.';
});
Route::post('/login', [AuthController::class, 'login']);
