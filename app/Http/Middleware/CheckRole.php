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
            return redirect('/forbidden');
        }

        if ($user->roles['rl_admin'] != $requiredrole) {
            return redirect()->back();
        }

        return $next($request);
    }
}
