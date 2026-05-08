<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-API-TOKEN');

        if (!$token) {
            return response()->json(['message' => '認証できません。'], 401);
        }

        $user = User::where('api_token', $token)->first();


        if (!$user) {
            return response()->json(['message' => '無効なトークンです。'], 401);
        }

        auth()->login($user);

        return $next($request);
    }
}
