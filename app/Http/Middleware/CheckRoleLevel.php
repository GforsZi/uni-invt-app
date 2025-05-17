<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Web\auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleLevel
{
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $requiredLevel
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next, $requiredLevel): Response
    {
        $user = FacadesAuth::user();

        if (!$user || !$user->role) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($user->role->level <= $requiredLevel) {
            return response()->json(['message' => 'Access denied: insufficient role level.'], 403);
        }

        return $next($request);
    }
}
