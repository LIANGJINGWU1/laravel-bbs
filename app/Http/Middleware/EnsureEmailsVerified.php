<?php


namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user() && !$request->user()->hasVerifiedEmail() && !$request->is('email/*', 'logout'))
        {
            return $request->expectsJson()  ? abort('403', 'you are not authorized') : redirect()->
                route('verification.notice');
        }

        return $next($request);
    }
}
