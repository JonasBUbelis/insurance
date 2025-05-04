<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Replace
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Start before system loads
        $response=$next($request);
        $html=$response->getContent();
        $html=str_replace('[shortcode]','replace',$html);
        $response->setContent($html);
        // Starts after system loads

        return $response;
    }
}
