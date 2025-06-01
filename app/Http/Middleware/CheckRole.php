<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Web\auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $requiredLevel
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next, $requiredrole): Response
    {
        $user = auth()->user();

        if (!$user || !$user->roles || $user->usr_activation == 0) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($user->roles['rl_name'] != $requiredrole) {
            return response()->json(['message' => 'Access denied: insufficient role level.'], 403);
        }

        return $next($request);
    }
}
