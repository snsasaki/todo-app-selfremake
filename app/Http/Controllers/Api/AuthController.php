<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->api_token = bin2hex(random_bytes(40));
        $user->save();

        Auth::login($user);
        session()->regenerate();

        return response()->json([
            'status' => 'success',
            'message' => '新規ユーザーを登録しました。',
        ]);
    }

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
            session()->regenerate();
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

    public function logout(): JsonResponse
    {
        if (Auth::logout() == null) {
            session()->invalidate();
            session()->regenerateToken();
            return response()->json([
                'status' => 'success',
                'message' => 'ログアウトが成功しました。',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'ログアウトが失敗しました。',
            ]);
        }
    }
}
