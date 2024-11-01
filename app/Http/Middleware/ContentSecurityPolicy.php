<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $csp = "default-src 'self'; " .
               "script-src 'self' https://cdnjs.cloudflare.com; " . // Allow scripts from your domain and CDN
               "style-src 'self'; " . // Allow styles from your domain and inline styles
               "img-src 'self' data:; " . // Allow images from your domain and inline images
               "connect-src 'self'; " . // Allow AJAX calls to your domain
               "frame-ancestors 'none';"; // Prevent framing of your site

        $response->header('Content-Security-Policy', $csp);

        return $response;
    }
}
