<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Web\auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class CheckActivation
{
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $requiredLevel
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next, $requiredActivation): Response
    {
        $user = auth()->user();

        if ($user->usr_activation != $requiredActivation) {
            return redirect('/forbidden');
        }

        return $next($request);
    }
}
