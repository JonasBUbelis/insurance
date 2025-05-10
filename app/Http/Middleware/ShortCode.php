<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ShortCode as ShortCodeModel;

class ShortCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Start before system loads
        $response = $next($request);
        if (str_contains($response->headers->get('Content-Type'), 'text/html')) {
            $html = $response->getContent();

            $shortcodes = ShortCodeModel::all(['shortcode', 'replace']);

            foreach ($shortcodes as $shortcode) {
             $html = str_replace('[[' . $shortcode->shortcode . ']]', $shortcode->replace, $html);}

            $response->setContent($html);
        }
        // Starts after system loads
        return $response;
    }
}
