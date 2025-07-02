<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // get token from header using laravel sanctum 
        $user =  Auth::user();
        // access to id of role table 
        if($user && $user->role_id == 3)
        {
        return $next($request);

        }
        return response()->json([
            'message' => 'Forbidden. You are not allowed to access this resource.'
        ], 403);
    }
}
