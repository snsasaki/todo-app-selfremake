<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        $user->api_token = bin2hex(random_bytes(40));
        $user->save();

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            return response()->json([
                'status' => 'success',
                'message' => 'ログインが成功しました。',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'ログインが失敗しました。',
            ]);
        }
    }
}
