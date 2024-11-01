<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XFrameOptions
{
    public function handle($request, Closure $next)
{
    $response = $next($request);
    
    $response->header('X-Frame-Options', 'DENY'); // или 'SAMEORIGIN'
    $response->header("Content-Security-Policy", "frame-ancestors 'self'");

    return $response;
}
    
}
